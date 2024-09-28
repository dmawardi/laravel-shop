<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category, Request $request)
    {
        // Get all products in the current category and its children
        $productsQuery = $category->allProducts()->toQuery();

        // Apply Price Filters if present
        // if ($request->filled('min_price')) {
        //     $productsQuery->where('price', '>=', $request->input('min_price'));
        // }

        // if ($request->filled('max_price')) {
        //     $productsQuery->where('price', '<=', $request->input('max_price'));
        // }

        // Apply Brand Filters if present
        if ($request->filled('brands')) {
            $productsQuery->whereIn('brand_id', $request->input('brands'));
        }

        // Paginate the filtered products
        $products = $productsQuery->paginate(12);

        // Retrieve all brands for the filter section
        $uniqueBrands = Product::select('brand')->distinct()->pluck('brand');

        // dd($category);
        return view('category.show', [
            'category' => $category,
            'products' => $products,
            'brands' => $uniqueBrands,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
