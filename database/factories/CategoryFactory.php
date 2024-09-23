<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


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
        $this->faker->unique(true); // Resets the unique checks

        $slug = Str::slug($this->faker->unique()->slug(3));
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'slug' => $slug,
            'parent_id' => null,
        ];
    }

    /**
     * Configure the factory to create categories with a specified number of products.
     *
     * @param  int  $count Number of products to create in each category.
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
}
