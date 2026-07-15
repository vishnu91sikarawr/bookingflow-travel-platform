<?php

namespace App\Http\Requests\BusRoute;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bus_operator_id' => ['required', 'exists:bus_operators,id'],
            'name' => ['required', 'string', 'max:255'],
            'source_city' => ['required', 'string', 'max:255'],
            'destination_city' => ['required', 'string', 'max:255'],
            'distance_km' => ['nullable', 'integer', 'min:1'],
            'estimated_duration' => ['nullable', 'string', 'max:100'],
            'status' => ['required', 'boolean'],
        ];
    }
}
