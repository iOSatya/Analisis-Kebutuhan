<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // GET /api/barangs
    public function index()
    {
        return Barang::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    // POST /api/barangs
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     */
    // GET /api/barangs/{id}
    public function show($id)
    {
        return Barang::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    // PUT /api/barangs/{id}
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

    /**
     * Remove the specified resource from storage.
     */
    // DELETE /api/barangs/{id}
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json(null, 204);
    }
}
