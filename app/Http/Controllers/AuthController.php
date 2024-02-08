<?php


namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        // Validación de credenciales
        $credentials = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];

        // Mensajes de error
        $mensajes = [
            'username.regex' => 'El campo username debe comenzar con una letra mayúscula y tener como máximo 10 caracteres.',
            'password.regex' => 'El campo password debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.'
        ];

        $validador = Validator::make($request->all(), $credentials, $mensajes);

        // Buscar el usuario en la base de datos
        $usuario = Usuario::where('username', $request->input('username'))->first();

        // Intento de autenticación utilizando el modelo Usuario
        if ($validador->fails() == false && $usuario && $usuario->password == $request->input('password')){

            $user = $usuario->toArray();

            // Persistir el usuario en la sesión
            $request->session()->put('user', $user);

            return redirect()->route('pelicula.index');
        }

        // Autenticación fallida
        return redirect()->route('login')->withErrors($validador);
    }
}