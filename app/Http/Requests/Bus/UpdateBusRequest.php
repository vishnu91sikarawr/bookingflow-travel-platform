<?php

namespace App\Http\Requests\Bus;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bus_operator_id' => 'required|exists:bus_operators,id',
            'name' => 'required|string|max:255',
            'bus_number' => [
                'required',
                'string',
                'max:100',
                Rule::unique('buses', 'bus_number')->ignore($this->bus),
            ],
            'registration_number' => 'nullable|string|max:100',
            'bus_type' => 'required',
            'total_seats' => 'required|integer|min:1',
            'status' => 'required|boolean',
        ];
    }
}
