<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\ShippingInformation;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use App\Models\Tag;
use App\Models\User;
use Database\Factories\ProductImageFactory;
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

        // Create 10 tags
        Tag::factory(10)->create();

        foreach ($this->brands as $brand) {
            Brand::factory()->create([
                'name' => $brand,
            ]);
        }


        // Create 5 collections
        Collection::factory(5)->create();
        
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

                    foreach ($products as $product) {
                        // Add 2 images to each product
                        ProductImage::factory(2)->forProduct($product)->create();
                        // Add 3 variants to each product
                        ProductVariant::factory(3)->forProduct($product)->create();
                        // Add 6 tags to each product
                        for ($k = 0; $k < 6; $k++) {
                            $product->tags()->attach($this->determineTagId());
                        }

                        // Add reviews to each product
                        Review::factory(3)->create([
                            'product_id' => $product->id,
                        ]);
                    }

                    // Attach a collection to each product
                    $products[0]->collections()->attach($this->determineCollectionId());
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

    // Function to determine which collection to assign to a product
    private function determineCollectionId()
    {
        // Fetch all existing collection IDs
        $existingCollectionIds = DB::table('collections')->pluck('id')->all();

        // Check if there are existing collections to choose from
        if (empty($existingCollectionIds)) {
            return null; // No existing collections
        }

        // Randomly decide which collection to assign
        return $existingCollectionIds[array_rand($existingCollectionIds)];
    }

    private function determineTagId()
    {
        // Fetch all existing tag IDs
        $existingTagIds = DB::table('tags')->pluck('id')->all();

        // Check if there are existing tags to choose from
        if (empty($existingTagIds)) {
            return null; // No existing tags
        }

        // Randomly decide which tag to assign
        return $existingTagIds[array_rand($existingTagIds)];
    }

    private $brands = [
        'AAVRANI',
        'ABBOTT',
        'Act+Acre',
        'adwoa beauty',
        'AERIN',
        'Algenist',
        'ALO',
        'Alpyn Beauty',
        'ALTERNA Haircare',
        'Ami Colé',
        'amika',
        'Anastasia Beverly Hills',
        'Aquis',
        'Ariana Grande',
        'Armani Beauty',
        'Artist Couture',
        'Augustinus Bader',
        'Azzaro',
        'BaBylissPRO',
        'bareMinerals',
        'BASMA',
        'BeautyBio',
        'Beautyblender',
        'belif',
        'Benefit Cosmetics',
        'Bio Ionic',
        'Biossance',
        'Blinc',
        'Bobbi Brown',
        'BondiBoost',
        'Boy Smells',
        'BREAD BEAUTY SUPPLY',
        'Briogeo',
        'BROWN GIRL Jane',
        'Bumble and bumble',
        'BURBERRY',
        'Buxom',
        'By Rosie Jane',
        'caliray',
        'CANOPY',
        'Carolina Herrera',
        'Caudalie',
        'CAY SKIN',
        'Ceremonia',
        'CHANEL',
        'Charlotte Tilbury',
        'Chloé',
        'Chunks',
        'ciele',
        'Cinema Secrets',
        'Clarins',
        'CLEAN RESERVE',
        'CLINIQUE',
        'COLOR WOW',
        'Commodity',
        'Community Sixty-Six',
        'COOLA',
        'Crown Affair',
        'Curlsmith'
    ];
    
}
