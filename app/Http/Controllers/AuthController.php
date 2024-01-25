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

            $user = $usuario->toArray();

            // Persistir el usuario en la sesión
            $request->session()->put('user', $user);

            // Redirigir según el tipo de usuario
            if ($usuario->type == 'Admin') {
                // Redirigir a la página de administrador pasando el tipo de usuario
                return redirect()->route('admin.pelicula.index');
            } else {
                return redirect()->route('alumno.pelicula.index');
            }
        }

        // Autenticación fallida
        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }
}