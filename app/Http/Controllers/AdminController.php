<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showIndex()
    {
        // Lógica para la vista del dashboard del administrador
        return view('admin.index');
    }
}
