<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            // Fake car name
            'product' => fake()->randomElement([
                'Toyota Corolla',
                'Honda Civic',
                'Ford Focus',
                'BMW 3 Series',
                'Tesla Model 3',
            ]),

            // Fake vehicle category
            'category' => fake()->randomElement([
                'Economy',
                'Compact',
                'Luxury',
                'SUV',
                'Electric',
                'Van',
            ]),

            // Number of vehicles available
            'quantity' => fake()->numberBetween(1, 20),

            // Daily rental price
            'price' => fake()->numberBetween(30, 200),
        ];
    }
}