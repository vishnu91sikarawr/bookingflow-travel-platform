<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SearchTripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from' => ['nullable', 'string', 'max:100'],
            'to' => ['nullable', 'string', 'max:100'],
            'journey_date' => ['nullable', 'date'],
        ];
    }
}
