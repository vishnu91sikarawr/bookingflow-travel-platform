<?php

namespace Database\Factories;

use App\Models\BusOperator;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BusOperator>
 */
class BusOperatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'code' => strtoupper(fake()->unique()->bothify('??###')),
            'email' => fake()->optional()->companyEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'website' => fake()->optional()->url(),
            'logo' => null,
            'address' => fake()->optional()->address(),
            'description' => fake()->optional()->paragraph(),
            'status' => true,
            'created_by' => User::factory(),
            'updated_by' => null,
        ];
    }

    /**
     * Indicate that the bus operator is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => false,
        ]);
    }
}
