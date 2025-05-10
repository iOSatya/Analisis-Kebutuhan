<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function get($id = null)
    {
        if ($id === null) {
            return Barang::where('visibility', true)->get();
        } else {
            return Barang::where('id', $id)
                        ->where('visibility', true)
                        ->firstOrFail();
        }
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'stock' => 'required|integer',
            'modal' => 'required|numeric',
        ]);
        $barang = Barang::create($validated);
        return response()->json(['message' => 'barang berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'sometimes|string',
            'harga_jual' => 'sometimes|numeric'
        ]);
        $barang->update($validated);
        $barang->save();
        return response()->json(['message' => 'barang berhasil diupdate']);
    }


    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->visibility = false;
        $barang->save();
        $barang->refresh();
        return response()->json(['message' => 'barang berhasil dihapus']);
    }
}
