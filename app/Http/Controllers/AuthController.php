<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intento de autenticación utilizando el modelo Usuario
        if (Auth::attempt($credentials)) {
            $usuario = Auth::user();

            // Redirigir según el tipo de usuario
            if ($usuario->type == 'Admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('alumno.index');
            }
        }

        // Autenticación fallida
        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }
}