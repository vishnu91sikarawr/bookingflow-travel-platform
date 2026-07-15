<?php

namespace App\Http\Requests\Trip;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'bus_operator_id' => ['required', 'exists:bus_operators,id'],

            'bus_id' => ['required', 'exists:buses,id'],

            'bus_route_id' => ['required', 'exists:bus_routes,id'],

            'departure_date' => ['required', 'date'],

            'departure_time' => ['required'],

            'arrival_time' => ['required', 'after:departure_time'],

            'fare' => ['required', 'numeric', 'min:0'],

            'status' => ['required', 'boolean'],
        ];
    }
}
