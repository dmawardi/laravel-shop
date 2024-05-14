<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
            'total' => $this->faker->numberBetween(100, 5000),
            'subtotal' => $this->faker->numberBetween(100, 5000),
            'tax' => $this->faker->numberBetween(5, 500),
            'shipping_fee' => $this->faker->numberBetween(5, 100),
            'discount' => $this->faker->numberBetween(5, 200),
            'payment_status' => $this->faker->randomElement(['pending', 'completed', 'failed']),
            'payment_method' => $this->faker->randomElement(['credit card', 'PayPal', 'bank transfer']),
            'transaction_id' => $this->faker->uuid,
            'paid_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'shipped_at' => $this->faker->dateTimeBetween('-1 month', 'now')
        ];
    }

    /**
     * Indicate that the order is pending.
     *
     * @return \Database\Factories\OrderFactory
     */
    public function pending(): OrderFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'pending',
            ];
        });
    }
}
