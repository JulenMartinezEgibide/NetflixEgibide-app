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

//Ruta de peliculas
Route::get('/pelicula', [PeliculaController::class, 'index'])->name('pelicula.index');
Route::get('/pelicula/create', [PeliculaController::class, 'create'])->name('pelicula.create');
Route::post('/pelicula', [PeliculaController::class, 'store'])->name('pelicula.store');
Route::get('/pelicula/{id}', [PeliculaController::class, 'show'])->name('pelicula.show');
Route::delete('/pelicula/{id}', [PeliculaController::class, 'destroy'])->name('pelicula.destroy');
Route::get('/pelicula/{id}/descarga', [PeliculaController::class, 'descargar'])->name('pelicula.descargar');

//Ruta de alumnos