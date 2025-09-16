<?php

namespace App\Services;

class DiscountCalculatorService
{
    private const PRICE_PATTERN = '/(\$[0-9,]+(?:\.[0-9]+)?)/';

    public function calculateDiscounts(string $input, float $percentage): array
    {
        if (!$this->validatePriceFormat($input)) {
            throw new \InvalidArgumentException('Invalid price format detected in input');
        }

        $originalPrices = $this->extractPrices($input);
        $processedText = $this->processTextWithDiscounts($input, $percentage);

        return [
            'original_text' => $input,
            'processed_text' => $processedText,
            'original_prices' => $originalPrices,
            'discount_percentage' => $percentage * 100,
            'prices_found' => count($originalPrices),
        ];
    }

    public function validatePriceFormat(string $input): bool
    {
        // Check if input contains at least one valid price
        return preg_match(self::PRICE_PATTERN, $input) === 1;
    }

    public function extractPrices(string $input): array
    {
        preg_match_all(self::PRICE_PATTERN, $input, $matches);

        return array_map(function ($priceString) {
            return (float) str_replace(['$', ','], '', $priceString);
        }, $matches[0] ?? []);
    }

    public function applyDiscountWithRounding(float $price, float $percentage): float
    {
        if ($price <= 0) {
            return 0;
        }

        if ($percentage <= 0 || $percentage > 1) {
            throw new \InvalidArgumentException('Percentage must be between 0 and 1');
        }

        $discountedPrice = $price * $percentage;

        // Round to the nearest 0.50
        return round($discountedPrice * 2) / 2;
    }

    public function formatPrice(float $price): string
    {
        return '$' . number_format($price, 2);
    }

    private function processTextWithDiscounts(string $input, float $percentage): string
    {
        $replacementCallback = function ($matches) use ($percentage) {
            $numericValue = (float) str_replace(',', '', substr($matches[0], 1));
            $discountedPrice = $this->applyDiscountWithRounding($numericValue, $percentage);
            return $this->formatPrice($discountedPrice);
        };

        return preg_replace_callback(self::PRICE_PATTERN, $replacementCallback, $input);
    }

    public function getStatistics(array $originalPrices, float $percentage): array
    {
        if (empty($originalPrices)) {
            return [
                'total_original' => 0,
                'total_discounted' => 0,
                'total_savings' => 0,
                'average_original' => 0,
                'average_discounted' => 0,
            ];
        }

        $totalOriginal = array_sum($originalPrices);
        $discountedPrices = array_map(
            fn($price) => $this->applyDiscountWithRounding($price, $percentage),
            $originalPrices
        );
        $totalDiscounted = array_sum($discountedPrices);

        return [
            'total_original' => $totalOriginal,
            'total_discounted' => $totalDiscounted,
            'total_savings' => $totalOriginal - $totalDiscounted,
            'average_original' => $totalOriginal / count($originalPrices),
            'average_discounted' => $totalDiscounted / count($discountedPrices),
        ];
    }
}