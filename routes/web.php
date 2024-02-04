<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EpisodioController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\UsuarioController;

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
Route::get('/peliculas', [PeliculaController::class, 'index'])->name('pelicula.index');
Route::post('/peliculas/load', [PeliculaController::class, 'load'])->name('pelicula.load');
Route::get('/peliculas/create', [PeliculaController::class, 'create'])->name('pelicula.create');
Route::post('/peliculas', [PeliculaController::class, 'store'])->name('pelicula.store');
Route::get('/peliculas/{id}', [PeliculaController::class, 'show'])->name('pelicula.show');
Route::delete('/peliculas/{id}', [PeliculaController::class, 'destroy'])->name('pelicula.destroy');
Route::get('/peliculas/{id}/descarga', [PeliculaController::class, 'descargar'])->name('pelicula.descargar');

//Ruta de usuarios
Route::get('/user', [UsuarioController::class, 'index'])->name('usuario.index');
Route::post('/user/load', [UsuarioController::class, 'load'])->name('usuario.load');
Route::get('/user/create', [UsuarioController::class, 'create'])->name('usuario.create');
Route::post('/user', [UsuarioController::class, 'store'])->name('usuario.store');
Route::get('/user/{id}', [UsuarioController::class, 'show'])->name('usuario.show');
Route::delete('/user/{id}', [UsuarioController::class, 'destroy'])->name('usuario.destroy');

//Ruta series
Route::get('/series', [SerieController::class, 'index'])->name('serie.index');
Route::post('/series/load', [SerieController::class, 'load'])->name('serie.load');
Route::get('/series/create', [SerieController::class, 'create'])->name('serie.create');
Route::post('/series', [SerieController::class, 'store'])->name('serie.store');
Route::get('/series/{id}', [SerieController::class, 'show'])->name('serie.show');
Route::delete('/series/{id}', [SerieController::class, 'destroy'])->name('serie.destroy');
Route::get('/series/{id}/descarga', [SerieController::class, 'descargar'])->name('serie.descargar');

//Ruta episodios
Route::prefix('series/{id}/episodio')->group(function () {
    Route::get('create', [EpisodioController::class, 'create'])->name('episodio.create');
    Route::post('create', [EpisodioController::class, 'store'])->name('episodio.store');
    Route::get('{id_ep}', [EpisodioController::class, 'show'])->name('episodio.show');
    Route::delete('{id_ep}', [EpisodioController::class, 'destroy'])->name('episodio.destroy');
    Route::get('{id_ep}/descarga', [EpisodioController::class, 'descargar'])->name('episodio.descargar');

});