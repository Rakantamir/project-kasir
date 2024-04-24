<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    use HasFactory;
    protected $fillable = [
        'TanggalPenjualan',
        'TotalHarga',
        'Bayar',
        'Kembalian',
        'PelangganID',
        'created_by',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID');
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'PenjualanID');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
