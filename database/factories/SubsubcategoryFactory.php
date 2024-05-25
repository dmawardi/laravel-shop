<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subsubcategory>
 */
class SubsubcategoryFactory extends Factory
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
            'subcategory_id' => Subcategory::factory(),
            'slug' => $slug,
        ];
    }
}
