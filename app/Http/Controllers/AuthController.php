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

            return redirect()->route('pelicula.index');
        }

        // Autenticación fallida
        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }
}