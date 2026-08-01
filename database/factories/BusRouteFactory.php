<?php

namespace Database\Factories;

use App\Models\BusOperator;

use Illuminate\Database\Eloquent\Factories\Factory;

class BusRouteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'bus_operator_id' => BusOperator::factory(),

            'name' => fake()->city().' Route',

            'source_city' => fake()->city(),

            'destination_city' => fake()->city(),

            'distance_km' => fake()->numberBetween(50, 800),

            'estimated_duration' => fake()->numberBetween(1, 12).' Hours',

            'status' => true,
        ];
    }
}
