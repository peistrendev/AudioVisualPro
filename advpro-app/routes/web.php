<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ContratosController;

Route::get('/', function () {
    return view('dashboard');
});


//Rutas para Clientes
Route::get('/clientes/panel',[ClientesController::class, 'index']);
Route::post('/clientes/save', [ClientesController::class, 'store']);
Route::get('/clientes/{cliente}/edit', [ClientesController::class, 'edit']);
Route::put('/clientes/{cliente}', [ClientesController::class, 'update']);
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy']);

//Rutas para Contratos
Route::get('/contratos/panel',[ContratosController::class, 'index']);
