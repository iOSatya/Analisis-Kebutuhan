<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Utang;
use Illuminate\Http\Request;

class UtangController extends Controller
{
    public function get()
    {
        return Utang::all();
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'tanggal_berhutang' => 'required|date',
            'nama' => 'required|string',
            'barang_id' => 'required|integer',
            'nama_barang' => 'required|string',
            'jumlah_barang' => 'required|integer',
            'nominal_utang' => 'required|numeric'
        ]);
        Utang::create($validated);
        $barang = Barang::findOrFail($validated['barang_id']);
        $barang->terjual += $validated['jumlah_barang'];
        $barang->save();
        return response()->json(['message' => 'utang berhasil dicatat']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal_lunas' => 'required|date'
        ]);
        $utang = Utang::findOrFail($id);
        $utang->update($validated);
        $utang->save();
        $barang = Barang::findOrFail($utang->barang_id);
        $barang->pendapatan += $utang->nominal_utang;
        $barang->save();
        return response()->json(['message' => 'utang berhasil dilunasi']);
    }

    public function delete($id)
    {
        $utang = Utang::findOrFail($id);
        $utang->delete();
        return response()->json(['message' => 'utang berhasil dihapus']);
    }
}
