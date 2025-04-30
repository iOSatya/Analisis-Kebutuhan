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

    public function add(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'stock' => 'required|integer',
            'harga' => 'required|numeric',
        ]);
        $barang = Barang::create($validated);

        return response()->json($barang, 201);
    }


    public function get($id)
    {
        return Barang::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'stock' => 'sometimes|integer',
            'terjual' => 'sometimes|integer',
            'harga' => 'sometimes|numeric',
        ]);

        $barang->update($validated);

        return response()->json($barang);
    }

    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json($barang);
    }
}
