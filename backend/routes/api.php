<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

// Rutas API para Productos (GET y POST)
Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/productos', [ProductoController::class, 'store']);
