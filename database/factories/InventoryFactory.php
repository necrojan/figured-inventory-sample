<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Application', 'Purchase']),
            'quantity' => rand(1, 5),
            'unit_price' => $this->faker->randomFloat('2', 0, 3)
        ];
    }
}
