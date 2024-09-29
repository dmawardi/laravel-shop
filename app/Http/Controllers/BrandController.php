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

    public function show(Brand $brand)
    {
        $products = $brand->products()->paginate();
        // dd($brand);
        return view('brand.show', [
            'brand' => $brand,
            'products' => $products,
        ]);
    }
}
