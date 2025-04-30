<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeuanganController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");



// barang
Route::get("/barang", [BarangController::class, "getAll"]);
Route::get("/barang/{id}", [BarangController::class, "get"]);
// body example for POST barang (add): 
// { "nama": "aqua", "stock": 30, "harga": 4000 }
Route::post("/barang", [BarangController::class, "add"]);
// body example for PUT barang (update): 
// { "nama": "aqua mineral", "stock": 30, "terjual": 0, "harga": 4000 }
// or can be partial update example: { "stock": 30 } or { "terjual": 0 }
Route::put("/barang/{id}", [BarangController::class, "update"]);
Route::delete("/barang/{id}", [BarangController::class, "delete"]);



// keuangan | date format: YYYY-MM-DD, example: 2025-05-01
Route::get("/keuangan", [KeuanganController::class, "getAll"]);
Route::get("/keuangan/{date}", [KeuanganController::class, "getAndCreate"]);
// body example for PUT keuangan: {"pendapatan": 10000, "ekspektasi": 20000} 
// or can be partial update example: {"pendapatan": 10000} or {"ekspektasi": 20000}
Route::put("/keuangan/{date}", [KeuanganController::class, "update"]); 