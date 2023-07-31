<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function showForm()
    {
        $selectedSettings = session('selected_settings', '95');

        return view('index', compact('selectedSettings'));
    }

    public function submitForm(Request $request)
    {
        $input = $request->input('input');
        $percentage = (float) $request->input('settings') / 100;
        
        // Regular expression to find numbers and replace them with "$" next to it
        $pattern = '/(\$[0-9,]+(?:\.[0-9]+)?)/';
        $replacementCallback = function ($matches) use ($percentage) {
            $numericValue = (float)str_replace(',', '', substr($matches[0], 1));
            $result = $numericValue * $percentage;
            $roundedResult = round($result * 2) / 2; // Round to the nearest 0.50
            return '$' . number_format($roundedResult, 2);
        };

        $result = preg_replace_callback($pattern, $replacementCallback, $input);


        $selectedSettings = $request->input('settings');
        session(['selected_settings' => $selectedSettings]);

        return view('index', 
            compact(
                'input',
                'result',
                'selectedSettings',
            )
        );
    }
}
