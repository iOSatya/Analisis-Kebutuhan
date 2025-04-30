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

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'stock' => 'sometimes|required|integer',
            'terjual' => 'nullable|integer',
            'harga' => 'sometimes|required|numeric',
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
