<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
        ];
    }

    /**
     * Configure the factory to create categories with a specified number of products.
     *
     * @param  int  $count Number of products to create in each category.
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withProducts($count = 10)
    {
        return $this->has(
            Product::factory()->count($count), // Create $count products
            'products'  // This should match the relationship name defined in the Category model
        );
    }
}
