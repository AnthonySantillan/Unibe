<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customers>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city' => fake()->words(), 
            'parish' => fake()->words(), 
            'sector' => fake()->words(), 
            'neighborhood' => fake()->words(), 
            'main_street' => fake()->words(), 
            'back_street' => fake()->words(), 
            'house_number' => fake()->words(), 
            'reference' => fake()->words(), 
        ];
    }
}
