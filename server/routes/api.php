<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Http\Request;
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


// transaksi
Route::get("/transaksi", [TransaksiController::class, "getAll"]);
Route::get("/transaksi/{transaksi_uid}", [TransaksiController::class, "get"]);
// body example for POST transaksi (add): {"barang_id": [1, 2], "nama": ["aqua", "mie"], "harga": [3000, 3500], "jumlah_barang": [2, 3], "total": [6000, 7000] }
Route::post("/transaksi", [TransaksiController::class, "add"]);