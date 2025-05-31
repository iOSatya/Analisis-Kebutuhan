<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UtangController;
use Illuminate\Support\Facades\Route;



// auth
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");



// barang
Route::get("/barang", [BarangController::class, "get"]);
Route::get("/barang/{id}", [BarangController::class, "get"]);
// body example for POST barang: { "nama": "aqua", "harga_beli": 2500, "harga_jual": 3000, "stock": 30, "modal": 75000 }
Route::post("/barang", [BarangController::class, "add"]);
// body example for PUT barang: { "nama": "aqua mineral", "harga_jual": 3500 } or { "nama": "aqua mineral" } or { "harga_jual": 3500 }
Route::put("/barang/{id}", [BarangController::class, "update"]);
Route::delete("/barang/{id}", [BarangController::class, "delete"]);



// utang
Route::get("/utang", [UtangController::class, "get"]);
// body example for POST utang: { "tanggal_berhutang": "2025-05-11", "nama": "aqua", "barang_id": 1, "nama_barang": "aqua", "jumlah_barang": 2, "nominal_utang": 6000 }
Route::post("/utang", [UtangController::class, "add"]);
// body example for PUT utang: { "tanggal_lunas": "2025-05-11" }
Route::put("/utang/{id}", [UtangController::class, "update"]);
Route::delete("/utang/{id}", [UtangController::class, "delete"]);



// transaksi
Route::get("/transaksi", [TransaksiController::class, "get"]);
// tanggal format (YYYY-MM-DD) example: 2025-1-20
Route::get("/transaksi/{tanggal}", [TransaksiController::class, "get"]);
// body example for POST transaksi (add): {"barang_id": [1, 2], "nama": ["aqua", "mie"], "harga": [3000, 3500], "jumlah_barang": [2, 3], "total": [6000, 7000] }
Route::post("/transaksi", [TransaksiController::class, "add"]);
