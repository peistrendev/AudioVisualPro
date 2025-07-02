<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ContratoController;
use App\Http\Controllers\Api\ProyectoController;
use App\Http\Controllers\Api\PersonalController;
use App\Http\Controllers\Api\EquipoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Definimos aquí todas las rutas de la aplicación.
| - Las rutas de invitado (guest) solo las ven los no autenticados.
| - Las rutas de auth solo las ven los autenticados.
| - Cualquier otra ruta desconocida dispara el fallback.
|
*/
Auth::routes(); 
// 1. Ruta raíz para invitados: redirige a /login.
//    Si ya estás autenticado, el middleware 'guest' te enviará a /home.
Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest')->name('root');


// 2. Rutas de autenticación (guest)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Registro
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // (Opcional) Recuperación de contraseña...
});


// 3. Rutas protegidas (auth)
Route::middleware('auth')->group(function () {
    // Dashboard / Home
    Route::get('/home',             [DashboardController::class, 'index'])->name('home');
    Route::get('/inicio/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout (POST)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Reportes
    Route::get('clientes/reporte',       [ClienteController::class,  'generarReporte'])->name('clientes.reporte');
    Route::get('equipos/reporte',        [EquipoController::class,  'generarReporte'])->name('equipos.reporte');
    Route::get('proyectos/exportar-pdf', [ProyectoController::class,'exportarPdf'])->name('proyectos.exportar-pdf');
    Route::get('personal/reporte-pdf',   [PersonalController::class,'exportarPdf'])->name('personal.exportar-pdf');

    // Recursos
    Route::resource('clientes',  ClienteController::class);
    Route::resource('contratos', ContratoController::class);
    Route::resource('proyectos', ProyectoController::class);
    Route::resource('personal',  PersonalController::class);
    Route::resource('equipos',   EquipoController::class);
});


// 4. Ruta pública de bienvenida
Route::get('/welcome', fn() => view('welcome'))->name('welcome');


// 5. Fallback: cualquier otra URI redirige a la raíz (`/`),
//    que a su vez enviará al invitado al login, o al usuario autenticado al home.
Route::fallback(fn() => redirect()->route('root'));
