<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ContratoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController; // Ensure this is correctly imported
use App\Http\Controllers\Api\ProyectoController;
use App\Http\Controllers\Api\PersonalController;
use App\Http\Controllers\Api\EquipoController;
<<<<<<< HEAD
use App\Http\Controllers\LoginController;
=======
use App\Http\Controllers\HomeController; // Added this use statement for clarity, though Auth::routes() manages it.

// IMPORTANT: This line defines ALL standard authentication routes (login, register, logout, password reset, and a default /home route).
Auth::routes();
>>>>>>> origin/RaulDev

// API Resource Routes
Route::resource('clientes', ClienteController::class);
Route::resource('contratos', ContratoController::class);
Route::resource('proyectos', ProyectoController::class);
Route::resource('personal', PersonalController::class);
Route::resource('equipos', EquipoController::class);


// --- Custom Home Route ---
// If not authenticated, redirect '/' to login
Route::get('/', function () {
    return redirect()->route('login'); // This 'login' route is defined by Auth::routes()
})->name('home'); // Renamed this to 'root' or similar if 'home' conflicts with Auth::routes() default, but 'login' redirect should handle it.


// --- Protected Routes (require authentication) ---
Route::middleware('auth')->group(function () {
    // Dashboard route, now protected and your primary dashboard after login.
    // The AuthController@login method should redirect to this route using ->intended('/inicio/dashboard')
    Route::get('/inicio/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout Route
    // Auth::routes() provides a POST /logout route by default.
    // You can keep this custom one if your AuthController@logout has specific
    // additional logic you want to execute, otherwise, the default one works.
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Any other routes that require authentication go here
});

// --- Public Welcome (if you still need it for some reason) ---
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Removed the duplicate Auth::routes(); and the explicit /home route
// as Auth::routes() already handles a /home route, and your primary dashboard is /inicio/dashboard.