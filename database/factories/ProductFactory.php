<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {  
        $this->faker->unique(true); // Resets the unique checks
        $slug = Str::slug($this->faker->unique()->slug(3));
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'slug' => $slug,
            'price' => $this->faker->randomFloat(2, 1, 100),
            // Select from a list of enums
            'brand_id' => Brand::factory(),
            'sku' => $this->faker->uuid(),
            'category_id' => Category::factory(),
        ];
    }

    public function forBrand(Brand $brand)
    {
        return $this->state([
            'brand_id' => $brand->id,
        ]);
    }

    public function forCategory(Category $category)
    {
        return $this->state([
            'category_id' => $category->id,
        ]);
    }
}
