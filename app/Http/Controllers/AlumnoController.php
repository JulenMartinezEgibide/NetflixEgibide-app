<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function showIndex()
    {
        // Lógica para la vista del dashboard del administrador
        return view('alumno.index');
    }
}
