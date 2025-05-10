<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'nama',
        'harga_beli',
        'harga_jual',
        'stock',
        'terjual',
        'sisa_stock',
        'modal',
        'ekspektasi_pendapatan',
        'pendapatan',
        'laba',
        'status'
    ];
}
