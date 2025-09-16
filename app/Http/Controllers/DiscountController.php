<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountFormRequest;
use App\Services\DiscountCalculatorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DiscountController extends Controller
{
    public function __construct(
        private readonly DiscountCalculatorService $discountCalculatorService
    ) {}

    public function showDiscountForm(): View
    {
        $selectedSettings = session('selected_settings', '95');

        return view('discount', compact('selectedSettings'));
    }

    public function submitForm(DiscountFormRequest $request): View|RedirectResponse
    {
        try {
            $input = $request->validated()['input'];
            $percentage = (float) $request->validated()['settings'] / 100;

            $calculationResult = $this->discountCalculatorService->calculateDiscounts($input, $percentage);
            $statistics = $this->discountCalculatorService->getStatistics(
                $calculationResult['original_prices'],
                $percentage
            );

            // Store settings in session
            session(['selected_settings' => $request->validated()['settings']]);

            return view('discount', [
                'input' => $calculationResult['original_text'],
                'result' => $calculationResult['processed_text'],
                'selectedSettings' => $request->validated()['settings'],
                'statistics' => $statistics,
                'success' => true,
            ]);

        } catch (\InvalidArgumentException $e) {
            return back()
                ->withErrors(['calculation' => $e->getMessage()])
                ->withInput();

        } catch (\Exception $e) {
            logger()->error('Discount calculation error', [
                'error' => $e->getMessage(),
                'input_length' => strlen($request->input('input', '')),
                'settings' => $request->input('settings'),
            ]);

            return back()
                ->withErrors(['calculation' => 'An error occurred while processing your request. Please try again.'])
                ->withInput();
        }
    }
}
