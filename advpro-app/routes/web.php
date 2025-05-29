<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProyectoController;

// Route::get('/', function () {
//     return view('/components/app-layout');
// });

//Rutas para Clientes
Route::get('/clientes/panel',[ClientesController::class, 'index']);
Route::post('/clientes/save', [ClientesController::class, 'store']);
Route::get('/clientes/{cliente}/edit', [ClientesController::class, 'edit']);
Route::put('/clientes/{cliente}', [ClientesController::class, 'update']);
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy']);

//Rutas para Contratos
Route::get('/contratos/panel',[ContratosController::class, 'index']);
Route::post('/contratos/save',[ContratosController::class, 'store']);
Route::get('/contratos/{contrato}/edit',[ContratosController::class, 'edit']);
Route::put('/contratos/{contrato}',[ContratosController::class, 'update']);
Route::delete('/contratos/{contrato}',[ContratosController::class, 'destroy']);

//rutas para Dashboard
Route::get('/', [DashboardController::class, 'index']);
Route::get('/inicio/dashboard', [DashboardController::class, 'index']);

// Rutas para Proyectos
Route::get('/proyectos/panel', [ProyectoController::class, 'index']);
Route::post('/proyectos/save', [ProyectoController::class, 'store']);
Route::get('/proyectos/{proyecto}/edit', [ProyectoController::class, 'edit']);
Route::put('/proyectos/{proyecto}', [ProyectoController::class, 'update']);
Route::delete('/proyectos/{proyecto}', [ProyectoController::class, 'destroy']);
