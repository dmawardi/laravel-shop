<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\ShippingInformation;
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
            'status' => $this->faker->randomElement(['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled', 'Refunded', 'Completed']),
            'total' => $this->faker->numberBetween(100, 5000),
            'subtotal' => $this->faker->numberBetween(100, 5000),
            'tax' => $this->faker->numberBetween(5, 500),
            'shipping_fee' => $this->faker->numberBetween(5, 100),
            'discount' => $this->faker->numberBetween(5, 200),
            'payment_status' => $this->faker->randomElement(['Paid', 'Unpaid', 'Refunded', 'Cancelled', 'Pending']),
            'payment_method' => $this->faker->randomElement(['Credit Card', 'PayPal', 'Bank Transfer', 'Stripe', 'Cash on Delivery']),
            'transaction_id' => $this->faker->uuid,
            'paid_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'shipped_at' => $this->faker->dateTimeBetween('-1 month', 'now')
        ];
    }

    /**
     * Define the state to create a complete order with items, payment, and shipping information.
     */
    public function withCompleteOrder()
    {
        return $this->afterCreating(function (Order $order) {
            $itemsCount = $this->faker->numberBetween(1, 5); // Random number of items
            $subtotal = 0;

            for ($i = 0; $i < $itemsCount; $i++) {
                $orderItem = OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'price' => $this->faker->numberBetween(20, 200)
                ]);
                $subtotal += $orderItem->subtotal;
            }

            $order->subtotal = $subtotal;
            $order->total = $subtotal + $order->tax + $order->shipping_fee - $order->discount;
            $order->save();

            Payment::factory()->create([
                'order_id' => $order->id,
                'amount' => $order->total,
                'payment_method' => $order->payment_method,
                'status' => $order->payment_status,
                'transaction_id' => $order->transaction_id
            ]);

            ShippingInformation::factory()->create([
                'order_id' => $order->id
            ]);
        });
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
