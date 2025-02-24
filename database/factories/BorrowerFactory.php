<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BorrowerFactory>
 */
class BorrowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'contact_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'thesis_name' => fake()->name(),
            'status' => fake()->randomElement(['active', 'returned', 'late', 'not_returned']),
            'returned_at' => fake()->dateTime(),
        ];
    }
}
