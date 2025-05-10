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
            'barang_id' => 'required|array',
            'nama' => 'required|array',
            'harga' => 'required|array',
            'jumlah_barang' => 'required|array',
            'total' => 'required|array',
        ]);

        $count = count($validated['nama']);

        for ($i = 0; $i < $count; $i++) {
            Transaksi::create([
                'barang_id' => $validated['barang_id'][$i],
                'nama' => $validated['nama'][$i],
                'harga' => $validated['harga'][$i],
                'jumlah_barang' => $validated['jumlah_barang'][$i],
                'total' => $validated['total'][$i],
            ]);

            $barang = Barang::findOrFail($validated['barang_id'][$i]);
            $barang->pendapatan += $validated['total'][$i];
            $barang->terjual += $validated['jumlah_barang'][$i];
            $barang->save();
        }

        return response()->json(['message' => 'transaksi berhasil disimpan']);
    }
}
