<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Review;
use App\Models\ShippingInformation;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use App\Models\User;
use Faker\Factory as FakerFactory; // Add this import statement

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $baseCategories = [
            'Make Up',
            'Skin Care',
            'Hair Care',
            'Fragrance',
            'Bath & Body',
            'Tools & Brushes'
        ];

        
        foreach ($baseCategories as $category) {
            // Randomly determine if the category should have a parent. If so, who
            $parentCategory = self::determineParentId();
            // Create a category
            $category = Category::factory()->create([
                'name' => $category,
            ]);


            // Create 2 subcategories within the category
            for ($i = 0; $i < 2; $i++) {
                $subcategory = Category::factory()->create([
                    'parent_id' => $category->id,
                ]);

                // Create 2 subsubcategories within the subcategory
                for ($j = 0; $j < 2; $j++) {
                    Category::factory()->create([
                        'parent_id' => $subcategory->id,
                    ]);

                    // Create 2 products within the category
                    $products = Product::factory(2)->create([
                        'category_id' => $category->id,
                    ]);
            
                    // Create 10 reviews for each product
                    foreach ($products as $product) {
                        Review::factory(3)->create([
                            'product_id' => $product->id,
                        ]);
                    }
                }
            }

          
        }
        // Create order with complete order items, payment, and shipping information
        // Order::factory()->withCompleteOrder()->create();
    }

    // Function to determine if a category should have a parent
    private function determineParentId()
    {
        // Fetch all existing category IDs
        $existingCategoryIds = DB::table('categories')->pluck('id')->all();

        // Check if there are existing categories to choose from
        if (empty($existingCategoryIds)) {
            return null; // No categories exist, so parent_id should be null
        }

        // Randomly decide if there should be a parent (50% chance)
        if (rand(0, 1) === 1) {
            // Randomly select an existing category ID
            return $existingCategoryIds[array_rand($existingCategoryIds)];
        }

        return null; // No parent, so return null
    }
}
