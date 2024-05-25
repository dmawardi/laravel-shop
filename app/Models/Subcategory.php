<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class Subcategory extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    public function mainCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subsubcategories(): HasMany
    {
        return $this->hasMany(Subsubcategory::class);
    }
}
