<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'NamaProduk',
        'Harga',
        'Stock',
        'Image',
    ];

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'ProdukID');
    }
}
