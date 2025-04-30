<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    // Update ekspektasi by current date (now)
    public function updateCurrentEkspektasiPendapatan(Request $request)
    {
        $request->validate([
            'ekspektasi' => 'required|integer',
        ]);

        // Get current date
        $today = now()->toDateString();

        $keuangan = Keuangan::where('periode', $today)->first();

        if (!$keuangan) {
            return response()->json(['message' => 'Data for today not found'], 404);
        }

        // Update ekspektasi
        $keuangan->ekspektasi = $request->ekspektasi;
        // Recalculate status
        $keuangan->status = $keuangan->pendapatan >= $keuangan->ekspektasi;
        $keuangan->save();

        return response()->json($keuangan);
    }

    // Update pendapatan by current date (now)
    public function updateCurrentPendapatan(Request $request)
    {
        $request->validate([
            'pendapatan' => 'required|integer',
        ]);

        // Get current date
        $today = now()->toDateString();

        $keuangan = Keuangan::where('periode', $today)->first();

        if (!$keuangan) {
            return response()->json(['message' => 'Data for today not found'], 404);
        }

        // Update pendapatan
        $keuangan->pendapatan = $request->pendapatan;
        // Recalculate status
        $keuangan->status = $keuangan->pendapatan >= $keuangan->ekspektasi;
        $keuangan->save();

        return response()->json($keuangan);
    }
}
