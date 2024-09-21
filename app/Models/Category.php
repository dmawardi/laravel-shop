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
}
