<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->base_price, 2);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
