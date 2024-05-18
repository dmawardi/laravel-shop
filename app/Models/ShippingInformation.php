<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class ShippingInformation extends Model
{
    use HasFactory, AsSource;

    public static $states = [
        'Aceh' => 'Aceh',
        'Bali' => 'Bali',
        'Bangka Belitung' => 'Bangka Belitung',
        'Banten' => 'Banten',
        'Bengkulu' => 'Bengkulu',
        'Gorontalo' => 'Gorontalo',
        'Jakarta' => 'Jakarta',
        'Jambi' => 'Jambi',
        'Jawa Barat' => 'Jawa Barat',
        'Jawa Tengah' => 'Jawa Tengah',
        'Jawa Timur' => 'Jawa Timur',
        'Kalimantan Barat' => 'Kalimantan Barat',
        'Kalimantan Selatan' => 'Kalimantan Selatan',
        'Kalimantan Tengah' => 'Kalimantan Tengah',
        'Kalimantan Timur' => 'Kalimantan Timur',
        'Kalimantan Utara' => 'Kalimantan Utara',
        'Kepulauan Riau' => 'Kepulauan Riau',
        'Lampung' => 'Lampung',
        'Maluku' => 'Maluku',
        'Maluku Utara' => 'Maluku Utara',
        'Nusa Tenggara Barat' => 'Nusa Tenggara Barat',
        'Nusa Tenggara Timur' => 'Nusa Tenggara Timur',
        'Papua' => 'Papua',
        'Papua Barat' => 'Papua Barat',
        'Riau' => 'Riau',
        'Sulawesi Barat' => 'Sulawesi Barat',
        'Sulawesi Selatan' => 'Sulawesi Selatan',
        'Sulawesi Tengah' => 'Sulawesi Tengah',
        'Sulawesi Tenggara' => 'Sulawesi Tenggara',
        'Sulawesi Utara' => 'Sulawesi Utara',
        'Sumatera Barat' => 'Sumatera Barat',
        'Sumatera Selatan' => 'Sumatera Selatan',
        'Sumatera Utara' => 'Sumatera Utara',
        'Yogyakarta' => 'Yogyakarta'
    ];

    public $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
