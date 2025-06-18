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
                'nama' => 'Indomie Goreng',
                'harga_beli' => 2500,
                'harga_jual' => 3000,
                'stock' => 20,
                'modal' => 50000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Chocolatos Cokelat',
                'harga_beli' => 700,
                'harga_jual' => 1000,
                'stock' => 20,
                'modal' => 14000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Wafer Nabati Cokelat',
                'harga_beli' => 600,
                'harga_jual' => 1000,
                'stock' => 20,
                'modal' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pepsodent Herbal',
                'harga_beli' => 8000,
                'harga_jual' => 10000,
                'stock' => 4,
                'modal' => 32000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Pantene Sashet',
                'harga_beli' => 1500,
                'harga_jual' => 2000,
                'stock' => 10,
                'modal' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Milo Sashet',
                'harga_beli' => 2500,
                'harga_jual' => 3000,
                'stock' => 16,
                'modal' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Marimas Sashet',
                'harga_beli' => 700,
                'harga_jual' => 1000,
                'stock' => 21,
                'modal' => 14700,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Soffel',
                'harga_beli' => 1500,
                'harga_jual' => 2000,
                'stock' => 9,
                'modal' => 9000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Kopi Ya Sashet',
                'harga_beli' => 1600,
                'harga_jual' => 2000,
                'stock' => 20,
                'modal' => 32000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Wafer Superstar',
                'harga_beli' => 1750,
                'harga_jual' => 2000,
                'stock' => 10,
                'modal' => 17500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
