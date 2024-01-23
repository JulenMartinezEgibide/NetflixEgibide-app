<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    public function index()
    {
        // Lógica para la vista del dashboard del administrador
        return view('pelicula.index');
    }
}
