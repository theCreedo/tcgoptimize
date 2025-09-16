<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'input' => [
                'required',
                'string',
                'max:10000',
                'regex:/^[\w\s\$\.,\-\n\r\(\)\[\]\/\\#@%&\*\+\=\:\;\"\']+$/',
            ],
            'settings' => [
                'required',
                'integer',
                'between:50,100',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'input.required' => 'Please enter some text with prices to calculate.',
            'input.max' => 'Input text is too long. Please limit to 10,000 characters.',
            'input.regex' => 'Input contains invalid characters. Please use only letters, numbers, prices, and basic punctuation.',
            'settings.required' => 'Please select a discount percentage.',
            'settings.between' => 'Discount percentage must be between 50% and 100%.',
        ];
    }

    public function attributes(): array
    {
        return [
            'input' => 'input text',
            'settings' => 'discount percentage',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Sanitize input to prevent XSS
        $this->merge([
            'input' => strip_tags($this->input ?? ''),
            'settings' => (int) $this->settings,
        ]);
    }
}
