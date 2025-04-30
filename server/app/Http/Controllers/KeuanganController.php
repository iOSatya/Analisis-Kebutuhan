<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function getAll()
    {
        return Keuangan::all();
    }

    public function getAndCreate($date)
    {
        $keuangan = Keuangan::where('periode', $date)->first();

        if (!$keuangan) {
            $keuangan = Keuangan::create([
                'periode' => $date,
                'ekspektasi' => 0,
                'pendapatan' => 0, 
                'status' => 1       
            ]);
        }
    
        return response()->json($keuangan);
    }

    public function update(Request $request, $date)
    {
        $request->validate([
            'ekspektasi' => 'nullable|integer',
            'pendapatan' => 'nullable|integer',
        ]);
    
        $keuangan = Keuangan::where('periode', $date)->first();
    
        if (!$keuangan) {
            return response()->json(['message' => 'Data not found for the given date'], 404);
        }
    
        if (!is_null($request->ekspektasi)) {
            $keuangan->ekspektasi = $request->ekspektasi;
        }
    
        if (!is_null($request->pendapatan)) {
            $keuangan->pendapatan = $request->pendapatan;
        }
    
        // Always recalculate status
        $keuangan->status = $keuangan->pendapatan >= $keuangan->ekspektasi;
        $keuangan->save();
    
        return response()->json($keuangan);
    }
}
