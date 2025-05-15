<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksi')->insert([
            [
                'tanggal' => '2025-1-1 20:20:20',
                'barang_id' => 1,
                'nama' => "Indomie",
                'harga' => 3000,
                'jumlah_barang' => 2,
                'total' => 6000,
                'created_at' => now(),
            ],
            [
                'tanggal' => '2025-1-1 20:20:20',
                'barang_id' => 2,
                'nama' => "Rokok",
                'harga' => 20000,
                'jumlah_barang' => 2,
                'total' => 40000,
                'created_at' => now(),
            ],
        ]);
    }
}
