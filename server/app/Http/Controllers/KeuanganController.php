<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class KeuanganController extends Controller
{
    public function get()
    {
        return Barang::all();
    }
}