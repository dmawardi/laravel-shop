<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show(Collection $collection)
    {
        // Get all products in the current category and its children
        $productsQuery = $collection->products->toQuery();

        $products = $productsQuery->paginate(12);

        return view('collection.show', compact('collection', 'products'));
    }
}
