<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController; // Ahora apunta al controlador en la carpeta API
use App\Http\Controllers\Api\ContratoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\ProyectoController;
use App\Http\Controllers\Api\EquipoController;

// --- Rutas para Clientes (Usando `Api\ClienteController`) ---
Route::get('/clientes/panel', [ClienteController::class, 'index']);
Route::post('/clientes/save', [ClienteController::class, 'store']);
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit']);
Route::put('/clientes/{cliente}', [ClienteController::class, 'update']);
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy']);

// --- Rutas para Contratos ---
Route::get('/contratos/panel', [ContratoController::class, 'index']);
Route::post('/contratos/save', [ContratoController::class, 'store']);
Route::get('/contratos/{contrato}/edit', [ContratoController::class, 'edit']);
Route::put('/contratos/{contrato}', [ContratoController::class, 'update']);
Route::delete('/contratos/{contrato}', [ContratoController::class, 'destroy']);

// --- Rutas para Dashboard ---
Route::get('/', [DashboardController::class, 'index']);
Route::get('/inicio/dashboard', [DashboardController::class, 'index']);

// --- Rutas para Proyectos ---
Route::get('/proyectos/panel', [ProyectoController::class, 'index']);
Route::post('/proyectos/save', [ProyectoController::class, 'store']);
Route::get('/proyectos/{proyecto}/edit', [ProyectoController::class, 'edit']);
Route::put('/proyectos/{proyecto}', [ProyectoController::class, 'update']);
Route::delete('/proyectos/{proyecto}', [ProyectoController::class, 'destroy']);

// --- Rutas para Equipos ---
Route::get('/equipos/panel', [EquipoController::class, 'index']);
Route::post('/equipos/save', [EquipoController::class, 'store']);
Route::get('/equipos/{equipo}/edit', [EquipoController::class, 'edit']);
Route::put('/equipos/{equipo}', [EquipoController::class, 'update']);
Route::delete('/equipos/{equipo}', [EquipoController::class, 'destroy']);

// --- Rutas para login y registro ---
Route::view('/login', 'login.login')->name('login');
Route::view('/register', 'login.register')->name('register');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
?>