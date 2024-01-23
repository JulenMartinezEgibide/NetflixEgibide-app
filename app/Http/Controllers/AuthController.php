<?php


namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('username', $credentials['username'])->first();

        // Intento de autenticación utilizando el modelo Usuario
        if ($usuario && $usuario->password == $credentials['password']) {

            // Redirigir según el tipo de usuario
            if ($usuario->type == 'Admin') {
                // Redirigir a la página de administrador pasando el tipo de usuario
                return redirect()->route('pelicula.index')->with(['userType' => 'Admin', 'userId' => $usuario->id]);
            } else {
                return redirect()->route('pelicula.index')->with(['userType' => 'Alumno', 'userId' => $usuario->id]);
            }
        }

        // Autenticación fallida
        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }
}