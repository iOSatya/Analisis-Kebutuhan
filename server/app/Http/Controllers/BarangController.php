<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    // GET /api/barang
    public function getAll()
    {
        return Barang::all();
    }

    // POST /api/barang
    public function add(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'stock' => 'required|integer',
            'terjual' => 'nullable|integer',
            'harga' => 'required|numeric',
        ]);
        // set terjual to 0 if in body not set
        $validated['terjual'] = $validated['terjual'] ?? 0;
        $barang = Barang::create($validated);

        return response()->json($barang, 201);
    }

    // GET /api/barang/{id}
    public function get($id)
    {
        return Barang::findOrFail($id);
    }

    // PUT /api/barang/{id}
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        // the body req can be all the 3, or only just one
        // example: {"nama": "Barang A", "stock": 10, "harga": 10000} or can be only {"stock": 10}
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'stock' => 'sometimes|integer',
            'harga' => 'sometimes|numeric',
        ]);

        $barang->update($validated);

        return response()->json($barang);
    }

    // DELETE /api/barangs/{id}
    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json($barang);
    }
}
