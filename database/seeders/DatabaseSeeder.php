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
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $baseCategories = [
            'Make Up',
            'Skin Care',
            'Hair Care',
            'Fragrance',
            'Bath & Body',
            'Tools & Brushes'
        ];

        foreach ($baseCategories as $category) {
            // Create a category
            $category = Category::factory()->create([
                'name' => $category,
            ]);
            // Create a subcategory
            $subcategory = Subcategory::factory()->create([
                'category_id' => $category->id,
            ]);
            // Create a subsubcategory
            Subsubcategory::factory()->create([
                'subcategory_id' => $subcategory->id,
            ]);
            // Create 10 products within the subsubcategory
            $products = Product::factory(10)->create([
                'subsubcategory_id' => $subcategory->id,
            ]);

            // Create 10 reviews for each product
            foreach ($products as $product) {
                Review::factory(10)->create([
                    'product_id' => $product->id,
                ]);
            }
        }


        // Create 10 Orders with complete order items, payment, and shipping information
        // Order::factory(10)->withCompleteOrder()->create();
        // // Create reviews
        // Review::factory(50)->create();
    }
}
