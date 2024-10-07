<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->bothify('??-########'),
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(100, 1000),
            'discount' => $this->faker->numberBetween(0, 100),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->imageUrl(),
        ];
    }

    /**
     * Indicate that the variant belongs to a product.
     *
     * @param int $productId
     * @return \Database\Factories\ProductVariantFactory
     */
    public function forProduct(Product $product): ProductVariantFactory
    {
        return $this->state(fn(array $attributes) => [
            'product_id' => $product->id,
        ]);
    }
}
