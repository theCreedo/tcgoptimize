<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PercentOffController extends Controller
{
    public function showForm()
    {
        return view('index');
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


        return view('index', 
            compact(
                'input',
                'result'
            )
        );
    }
}
