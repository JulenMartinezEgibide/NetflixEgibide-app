<?php


namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('alumno.index');
            }
        }

        // Autenticación fallida
        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }
}