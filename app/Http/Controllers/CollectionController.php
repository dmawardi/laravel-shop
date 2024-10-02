<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show(Collection $collection, Request $request)
    {
        // Get all products in the current category and its children
        $productsQuery = $collection->products->toQuery();

        // If the category is present in the request, filter by it
        if ($request->filled('category')) {
            // Grab the category ID from the request
            $categorySlug = $request->input('category');
            $category = Category::where('slug', $categorySlug)->first();
                        
            // Add the children categories to the array
            foreach ($category->childrenRecursive as $childCategory) {
                $categoryIds[] = $childCategory->id;
            }

            // Filter the products by the category ID
            $productsQuery->whereIn('category_id', $categoryIds);
        }

        $products = $productsQuery->paginate(12);
        // dump($products);

        // Get all the categories of the products in the collection that don't have a parent
        $collectionProductCategories = $collection->products->map(function ($product) {
            return $product->category->parent;
        });

        return view('collection.show',
        [
            'collection' => $collection,
            'products' => $products,
            'productCategories' => $collectionProductCategories->unique(),
        ]
    );
    }
}
