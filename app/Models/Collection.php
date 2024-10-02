<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function productCategories() 
    {
        return $this->products->map(function ($product) {
            return $product->category;
        });
    }

    // Get top parent of product categories in the collection
    public function productCategoriesTopParent()
    {
        return $this->productCategories()->map(function ($category) {
            return $category->parent->parent ?? $category->parent;
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
