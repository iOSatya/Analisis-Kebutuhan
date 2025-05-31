<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNumeric;

class BarangController extends Controller
{
    public function get($param = null)
    {
        if ($param === "terlaris") {
            $data = DB::table('barang')
                ->select('nama', DB::raw('SUM(terjual) as total_terjual'))
                ->groupBy('nama')
                ->orderByDesc('total_terjual')
                ->get();

            return response()->json($data);
        } elseif (is_numeric($param)) {
            return Barang::where('id', $param)
                        ->where('visibility', true)
                        ->firstOrFail();
        } else {
            return Barang::where('visibility', true)->get();
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
