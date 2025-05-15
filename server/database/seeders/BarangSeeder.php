<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            [
                'nama' => 'Indomie',
                'harga_beli' => 2500,
                'harga_jual' => 3000,
                'stock' => 20,
                'modal' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rokok',
                'harga_beli' => 15000,
                'harga_jual' => 20000,
                'stock' => 10,
                'modal' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
