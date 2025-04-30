<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// auth
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/logout", [AuthController::class, "logout"])->middleware("auth:sanctum");

// barang
Route::get("/barang", [BarangController::class, "getAll"]);
Route::get("/barang/{id}", [BarangController::class, "get"]);
Route::post("/barang", [BarangController::class, "add"]);
Route::put("/barang/{id}", [BarangController::class, "update"]);
Route::delete("/barang/{id}", [BarangController::class, "delete"]);