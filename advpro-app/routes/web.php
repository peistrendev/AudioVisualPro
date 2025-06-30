<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Asegúrate de que esto esté importado
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ContratoController;
use App\Http\Controllers\DashboardController; // Asegúrate de que esto esté importado
use App\Http\Controllers\AuthController;     // Asegúrate de que esto esté importado
use App\Http\Controllers\Api\ProyectoController;
use App\Http\Controllers\Api\PersonalController;
use App\Http\Controllers\Api\EquipoController;

// IMPORTANT: Esta línea define TODAS las rutas estándar de autenticación (login, register, logout, etc.).
// También define una ruta GET /home que por defecto apunta a App\Http\Controllers\HomeController.
Auth::routes();

// --- API Resource Routes ---
Route::resource('clientes', ClienteController::class);
Route::resource('contratos', ContratoController::class);
Route::resource('proyectos', ProyectoController::class);
Route::resource('personal', PersonalController::class);
Route::resource('equipos', EquipoController::class);

// --- Rutas Personalizadas para la "Home" y el Dashboard ---

// 1. La ruta /home ahora apunta a tu DashboardController.
//    Esta línea DEBE ir DESPUÉS de Auth::routes() para sobrescribir la ruta /home predeterminada.
Route::middleware('auth')->get('/home', [DashboardController::class, 'index'])->name('home');

// 2. La ruta raíz (/) redirige inteligentemente.
//    Si el usuario está autenticado, lo envía a /home (tu dashboard).
//    Si no está autenticado, lo envía a /login.
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home'); // Redirige al dashboard si está logueado
    }
    return redirect()->route('login'); // Redirige al login si no está logueado
})->name('root'); // Puedes nombrarla 'root' o simplemente dejarla sin nombre si no la vas a referenciar.


// --- Protected Routes (requieren autenticación) ---
Route::middleware('auth')->group(function () {
    // La ruta /inicio/dashboard (con nombre 'dashboard') es ahora redundante
    // ya que /home (con nombre 'home') es tu nuevo dashboard.
    // Puedes eliminarla o comentarla si no la necesitas para otro propósito.
    // Route::get('/inicio/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout Route (tu implementación personalizada, que es correcta)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Cualquier otra ruta que requiera autenticación va aquí...
});

// --- Public Welcome (si aún la necesitas para alguna página de bienvenida no autenticada) ---
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');