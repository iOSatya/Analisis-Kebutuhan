<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function get($tanggal = null)
    {
        if ($tanggal == null) {
            return Transaksi::all();
        } else {
            return Transaksi::whereDate('created_at', $tanggal)->get();
        }
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            '*.tanggal' => 'required|dateTime',
            '*.barang_id' => 'required|integer|exists:barang,id',
            '*.nama' => 'required|string',
            '*.harga' => 'required|numeric',
            '*.jumlah_barang' => 'required|integer|min:1',
            '*.total' => 'required|numeric',
        ]);

        foreach ($validated as $item) {
            Transaksi::create([
                'barang_id' => $item['barang_id'],
                'nama' => $item['nama'],
                'harga' => $item['harga'],
                'jumlah_barang' => $item['jumlah_barang'],
                'total' => $item['total'],
            ]);

            $barang = Barang::findOrFail($item['barang_id']);
            $barang->pendapatan += $item['total'];
            $barang->terjual += $item['jumlah_barang'];
            $barang->save();
        }

        return response()->json(['message' => 'transaksi berhasil disimpan']);
    }

}
