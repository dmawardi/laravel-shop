<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
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
            'name' => $this->faker->word,
            'category_id' => Category::factory(),
            'slug' => $slug,
        ];
    }
}
