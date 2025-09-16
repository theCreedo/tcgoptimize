<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{
    /**
     * Display the discount form.
     */
    public function showDiscountForm(): View
    {
        $selectedSettings = session('selected_settings', '95');

        return view('discount', compact('selectedSettings'));
    }

    /**
     * Process the discount calculation form submission.
     */
    public function submitForm(Request $request): View|RedirectResponse
    {
        try {
            $validatedData = $this->validateDiscountRequest($request);

            $input = $this->sanitizeInput($validatedData['input']);
            $percentage = (float) $validatedData['settings'] / 100;

            $result = $this->calculateDiscount($input, $percentage);

            session(['selected_settings' => $validatedData['settings']]);

            return view('discount', [
                'input' => $input,
                'result' => $result,
                'selectedSettings' => $validatedData['settings']
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Discount calculation failed', [
                'error' => $e->getMessage(),
                'input_length' => strlen($request->input('input', '')),
                'settings' => $request->input('settings'),
                'user_ip' => $request->ip()
            ]);

            return redirect()->back()
                ->withErrors(['error' => 'An error occurred processing your request. Please try again.'])
                ->withInput();
        }
    }

    /**
     * Validate the discount calculation request.
     */
    private function validateDiscountRequest(Request $request): array
    {
        return $request->validate([
            'input' => [
                'required',
                'string',
                'max:10000',
                'regex:/^[\s\S]*$/' // Allow reasonable characters only
            ],
            'settings' => [
                'required',
                'in:70,75,80,85,90,95' // Whitelist allowed discount percentages
            ]
        ], [
            'input.required' => 'Please provide text to process.',
            'input.max' => 'Input text is too long. Maximum 10,000 characters allowed.',
            'input.regex' => 'Input contains invalid characters.',
            'settings.required' => 'Please select a discount percentage.',
            'settings.in' => 'Invalid discount percentage selected.'
        ]);
    }

    /**
     * Sanitize user input to prevent XSS attacks.
     */
    private function sanitizeInput(string $input): string
    {
        // Remove HTML tags to prevent XSS
        $input = strip_tags($input);

        // Escape special characters
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        // Trim whitespace
        return trim($input);
    }

    /**
     * Calculate discount on dollar amounts in the input text.
     */
    private function calculateDiscount(string $input, float $percentage): string
    {
        // Pattern to match dollar amounts (e.g., $250, $1,000.50)
        $pattern = '/(\$[0-9,]+(?:\.[0-9]+)?)/';

        $replacementCallback = function ($matches) use ($percentage) {
            // Extract numeric value from dollar amount
            $numericValue = (float) str_replace(',', '', substr($matches[0], 1));

            // Calculate discounted amount
            $result = $numericValue * $percentage;

            // Round to nearest 0.50
            $roundedResult = round($result * 2) / 2;

            // Format as currency
            return '$' . number_format($roundedResult, 2);
        };

        $result = preg_replace_callback($pattern, $replacementCallback, $input);

        // Return original input if regex failed
        return $result !== null ? $result : $input;
    }
}