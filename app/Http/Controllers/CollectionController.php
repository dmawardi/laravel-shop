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

            $ancestors = $category->getAllChildrenAndSelfIds();
                        

            // Filter the products by the category ID
            $productsQuery->whereIn('category_id', $ancestors);
        }

        // Get paginated results
        $products = $productsQuery->paginate(12);

        $productCategoryParents = $collection->productCategoriesTopParent()->unique();

        return view('collection.show',
        [
            'collection' => $collection,
            'products' => $products,
            'productCategories' => $productCategoryParents,
        ]
    );
    }
}
