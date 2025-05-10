<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    public function getAll()
    {
        return Barang::all();
    }

    public function get($id)
    {
        return Barang::findOrFail($id);
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
        return response()->json($barang, 200);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|string',
            'harga_jual' => 'sometimes|numeric'
        ]);

        $barang->update($validated);

        return response()->json($barang->fresh());
    }


    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return response()->json($barang);
    }
}
