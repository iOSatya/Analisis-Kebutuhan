<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utang extends Model
{
    protected $table = 'utang';
    protected $fillable = [
        'tanggal_berhutang',
        'tanggal_lunas', 
        'nama',
        'barang_id',
        'nama_barang',
        'jumlah_barang',
        'nominal_utang',
        'status'
    ];
}
