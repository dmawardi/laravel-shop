<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingInformation>
 */
class ShippingInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { 
        return [
            'order_id' => Order::factory(),
            'address_line1' => $this->faker->streetAddress,
            'address_line2' => $this->faker->optional()->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode
        ];
    }
}
