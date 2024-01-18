<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return view('welcome');
});

// Ruta para mostrar el formulario de inicio de sesión
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Ruta para procesar la autenticación
Route::post('/login', [AuthController::class, 'login']);

// Rutas para el administrador
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', [AdminController::class, 'showIndex'])->name('admin.index');
});

// Rutas para el alumno
Route::group(['middleware' => ['auth', 'alumno']], function () {
    Route::get('/alumno',  [AlumnoController::class, 'showIndex'])->name('alumno.index');
});