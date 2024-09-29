<?php

namespace Database\Seeders;

use App\Models\Brand;
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

        // Create 5 brands
        Brand::factory(5)->create();
        
        foreach ($baseCategories as $category) {
            // Create a category
            $baseCategory = Category::factory()->create([
                'name' => $category,
            ]);


            // Create 4 subcategories within the category
            for ($i = 0; $i < 5; $i++) {
                $subcategory = Category::factory()->create([
                    'parent_id' => $baseCategory->id,
                ]);

                // Create 4 subsubcategories within the subcategory
                for ($j = 0; $j < 4; $j++) {
                    $subsubCategory = Category::factory()->create([
                        'parent_id' => $subcategory->id,
                    ]);

                    // Create 2 products within the category
                    $products = Product::factory(2)->create([
                        'category_id' => $subsubCategory->id,
                        'brand_id' => $this->determineBrandId(),
                    ]);
            
                    // Create 10 reviews for each product
                    // foreach ($products as $product) {
                    //     Review::factory(3)->create([
                    //         'product_id' => $product->id,
                    //     ]);
                    // }
                }
            }

          
        }
        // Create order with complete order items, payment, and shipping information
        // Order::factory()->withCompleteOrder()->create();
    }

    // Function to determine which brand to assign to a product
    private function determineBrandId()
    {
        // Fetch all existing brand IDs
        $existingCategoryIds = DB::table('brands')->pluck('id')->all();

        // Check if there are existing brands to choose from
        if (empty($existingCategoryIds)) {
            return null; // No existing brands
        }

        // Randomly decide which brand to assign
        return $existingCategoryIds[array_rand($existingCategoryIds)];
    }
}
