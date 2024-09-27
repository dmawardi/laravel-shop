<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class Category extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('childrenRecursive');
    }

    // Method to get all products from the category and all its children
    public function productsRecursive()
    {
        return $this->hasMany(Product::class)->with('category.childrenRecursive.products');
    }

    // Method to get all products from the category and all its children
    public function allProducts()
    {
        // Get IDs of the category and all its child categories
        $categoryIds = $this->getAllChildrenAndSelfIds();

        // Retrieve products from all these categories
        return Product::whereIn('category_id', $categoryIds)->get();
    }

    // Method to get all IDs including the category itself and all its children
    public function getAllChildrenAndSelfIds()
    {
        // Get the category ID itself
        $ids = [$this->id];

        // Get child category IDs recursively
        foreach ($this->childrenRecursive as $child) {
            $ids = array_merge($ids, $child->getAllChildrenAndSelfIds());
        }

        return $ids;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
