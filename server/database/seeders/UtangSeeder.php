<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UtangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('utang')->insert([
            [
                'tanggal_berhutang' => '2025-05-11',
                'nama' => 'kalfin',
                'barang_id' => 1,
                'nama_barang' => 'Indomie',
                'jumlah_barang' => 2,
                'nominal_utang' => 6000,
            ],
            [
                'tanggal_berhutang' => '2025-05-11',
                'nama' => 'fadhil',
                'barang_id' => 2,
                'nama_barang' => 'Rokok',
                'jumlah_barang' => 1,
                'nominal_utang' => 20000,
            ],
        ]);
    }
}
