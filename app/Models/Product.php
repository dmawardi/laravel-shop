<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Product extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
