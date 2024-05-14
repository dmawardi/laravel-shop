<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Payment extends Model
{
    use HasFactory, AsSource;

    public $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
