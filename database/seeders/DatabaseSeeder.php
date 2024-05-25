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
            // Create a category
            $category = Category::factory()->create([
                'name' => $category,
            ]);

            // Reset the faker instance
            // FakerFactory::create()->unique(true);
            // Create subcategories in category
            $subcategories = Subcategory::factory(2)->create([
                'category_id' => $category->id,
            ]);
            // Create subsubcategories in subcategory
            foreach ($subcategories as $subcategory) {
                // Reset the faker instance
                // FakerFactory::create()->unique(true);

                // Create subcategories
                $subsubcategories = Subsubcategory::factory(2)->create([
                    'subcategory_id' => $subcategory->id,
                ]);
                foreach ($subsubcategories as $subsubcategory) {
                    // Reset the faker instance
                    // FakerFactory::create()->unique(true);

                    // Create 10 products within the subsubcategory
                        $products = Product::factory(2)->create([
                            'subsubcategory_id' => $subsubcategory->id,
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

        FakerFactory::create()->unique(true);

        // Create 10 Orders with complete order items, payment, and shipping information
        Order::factory()->withCompleteOrder()->create();
        // // Create reviews
        // Review::factory(50)->create();
    }
}
