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
        echo Barang::findOrFail($id)['pendapatan'];
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
            'harga_jual' => 'sometimes|numeric',
            'pendapatan' => 'sometimes|numeric',
        ]);

        $fields = array_keys($validated);

        if ($fields === ['pendapatan']) {
            $barang->pendapatan += $validated['pendapatan'];
            $barang->save();
            $barang->refresh();
            return response()->json($barang);
        }

        if (in_array('pendapatan', $fields)) {
            return response()->json([
                'message' => 'You can only update pendapatan alone, not with other fields.'
            ], 422);
        }

        if (isset($validated['nama'])) {
            $barang->nama = $validated['nama'];
        }

        if (isset($validated['harga_jual'])) {
            $barang->harga_jual = $validated['harga_jual'];
        }

        $barang->save();
        $barang->refresh();
        return response()->json($barang);
    }

    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return response()->json($barang);
    }
}
