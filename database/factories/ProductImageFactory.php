<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'src' => $this->faker->imageUrl(),
            'alt' => $this->faker->sentence,
            'sort' => $this->faker->numberBetween(0, 100),
            'is_main' => $this->faker->boolean,
            'product_id' => Product::factory(),
        ];
    }

    public function forProduct(Product $product)
    {
        return $this->state([
            'product_id' => $product->id,
        ]);
    }
}
