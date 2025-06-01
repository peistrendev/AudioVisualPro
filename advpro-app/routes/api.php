<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importar controladores API
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ContratoController;
use App\Http\Controllers\Api\ProyectoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas para la API. Se cargan por el RouteServiceProvider
| dentro del grupo de middleware `api`, asegurando que sean tratadas como API REST.
|--------------------------------------------------------------------------
*/

// Ruta de ejemplo para autenticación de usuario (si la necesitas)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// --- Rutas API para Clientes ---
Route::get('/clientes/panel', [ClienteController::class, 'index']); // Vista y JSON
Route::post('/clientes/save', [ClienteController::class, 'store']);
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit']);
Route::put('/clientes/{cliente}', [ClienteController::class, 'update']);
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy']);

// --- Rutas API para Contratos ---
Route::get('/contratos/panel', [ContratoController::class, 'index']);
Route::post('/contratos/save', [ContratoController::class, 'store']);
Route::get('/contratos/{contrato}/edit', [ContratoController::class, 'edit']);
Route::put('/contratos/{contrato}', [ContratoController::class, 'update']);
Route::delete('/contratos/{contrato}', [ContratoController::class, 'destroy']);

// --- Rutas API para Proyectos ---
Route::get('/proyectos/panel', [ProyectoController::class, 'index']);
Route::post('/proyectos/save', [ProyectoController::class, 'store']);
Route::get('/proyectos/{proyecto}/edit', [ProyectoController::class, 'edit']);
Route::put('/proyectos/{proyecto}', [ProyectoController::class, 'update']);
Route::delete('/proyectos/{proyecto}', [ProyectoController::class, 'destroy']);

// 🛡️ Opcional: Autenticación con Sanctum
/*
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('contratos', ContratoController::class);
    Route::apiResource('proyectos', ProyectoController::class);
});
*/
