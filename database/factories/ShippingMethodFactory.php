<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingMethod>
 */
class ShippingMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'base_price' => $this->faker->randomFloat(2, 0, 100),
            'delivery_time' => $this->faker->randomElement(['1-2 days', '3-5 days', '1 week', '2 weeks']),
            'price_per_kg' => $this->faker->randomFloat(2, 0, 10),
            'price_per_item' => $this->faker->randomFloat(2, 0, 10),
            'price_per_m' => $this->faker->randomFloat(2, 0, 10),
            'price_per_cm' => $this->faker->randomFloat(2, 0, 10),
        ];
    }
}
