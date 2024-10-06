<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(),
            'is_active' => true,
            'is_featured' => $this->faker->boolean,
        ];
    }

    /**
     * Indicate that the brand is active.
     *
     * @return \Database\Factories\BrandFactory
     */
    public function active(): BrandFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    /**
     * Indicate that the brand is inactive.
     *
     * @return \Database\Factories\BrandFactory
     */
    public function inactive(): BrandFactory

    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }

    /**
     * Indicate that the brand is featured.
     *
     * @return \Database\Factories\BrandFactory
     */
    public function featured(): BrandFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_featured' => true,
            ];
        });
    }
    
    /**
     * Indicate that the brand is not featured.
     *
     * @return \Database\Factories\BrandFactory
     */
    public function notFeatured(): BrandFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_featured' => false,
            ];
        });
    }
}
