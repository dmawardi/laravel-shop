<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subsubcategory;
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
        $slug = Str::slug($this->faker->unique()->word(2));
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'quantity' => $this->faker->numberBetween(1, 100),
            'slug' => $slug,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'image' => 'https://via.placeholder.com/150',
            'sku' => $this->faker->unique()->uuid(),
            'subsubcategory_id' => Subsubcategory::factory(),
        ];
    }
}
