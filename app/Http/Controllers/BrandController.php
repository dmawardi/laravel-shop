<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('brand.index', [
            'brands' => Brand::all(),
        ]);
    }

    public function show(Brand $brand, Request $request)
    {
        // Get all products in the current category and its children
        $productsQuery = $brand->products->toQuery();

        // Apply Price Filters if present
        // if ($request->filled('min_price')) {
        //     $productsQuery->where('price', '>=', $request->input('min_price'));
        // }

        // if ($request->filled('max_price')) {
        //     $productsQuery->where('price', '<=', $request->input('max_price'));
        // }

        $products = $productsQuery->paginate(12);
        // dd($brand);
        return view('brand.show', [
            'brand' => $brand,
            'products' => $products,
        ]);
    }
}
