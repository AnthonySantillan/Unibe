<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customers>
 */
class CustomersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'identification_card' => fake()->numberBetween(),
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'email' => fake()->email(), 
            'phone' => fake()->phoneNumber(), 
            'role' => fake()->words(), 
            'state' => fake()->randomElement(['Activo', 'Eliminado'])

        ];
    }
}
