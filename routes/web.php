<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeliculaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login.index');
});

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', [AuthController::class, 'index'])->name('login.index');

// Ruta para procesar la autenticación
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Rutas para el administrador
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [PeliculaController::class, 'index'])->name('admin.pelicula.index');
});

// Rutas para el alumno
Route::group(['prefix' => 'alumno'], function () {
    Route::get('/',  [PeliculaController::class, 'index'])->name('alumno.pelicula.index');
});