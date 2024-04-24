<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;
    protected $fillable = [
        'PenjualanID',
        'ProdukID',
        'JumblahProduk',
        'Subtotal',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'ProdukID');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'PenjualanID');
    }
}
