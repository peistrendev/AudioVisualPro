<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ContratoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProyectoController;
use App\Http\Controllers\Api\PersonalController;
use App\Http\Controllers\Api\EquipoController;
use App\Http\Controllers\LoginController;

Route::resource('clientes', ClienteController::class);

Route::resource('contratos', ContratoController::class);

Route::resource('proyectos', ProyectoController::class);

Route::resource('personal', PersonalController::class);

Route::resource('equipos', EquipoController::class);



Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('/inicio/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');