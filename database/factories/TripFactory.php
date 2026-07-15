<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\BusOperator;
use App\Models\BusRoute;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    public function definition(): array
    {
        return [

            'bus_operator_id' => BusOperator::factory(),

            'bus_id' => Bus::factory(),

            'bus_route_id' => BusRoute::factory(),

            'trip_code' => 'TRP'.fake()->unique()->numberBetween(1000, 9999),

            'departure_date' => fake()->date(),

            'departure_time' => fake()->time(),

            'arrival_time' => fake()->time(),

            'fare' => fake()->randomFloat(2, 200, 2500),

            'available_seats' => fake()->numberBetween(20, 50),

            'status' => true,

        ];
    }
}
