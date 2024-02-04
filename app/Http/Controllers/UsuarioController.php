<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        // Lógica para la vista del dashboard del administrador
        $listaUsuarios = [];

        //

        //Coger los datos de las peliculas de la base de datos
        $usuarios = Usuario::all();

        //Por cada pelicula, coger el Nombre, Categoria, ArchivoImagen y id
        foreach ($usuarios as $usuario) {

            $listaUsuarios[] = [
                'username' => $usuario->username,
                'password' => $usuario->password,
                'id' => $usuario->id,
                'type' => $usuario->type,
                'ultima_busqueda' => $usuario->ultima_busqueda,

            ];
        }

        return view('usuario.index', ['usuarios' => $listaUsuarios]);
    }

    public function load(Request $request)
    {

        //Lógica para cargar las peliculas en la base de datos
        $listaUsuarios = [];

        //Si el metodo es post y el selector no es nulo
        if ($request->isMethod('post') && $request->input('selector') != null) {

            //Coger los datos de las peliculas de la base de datos
            $usuarios = Usuario::where('type', $request->input('selector'))->get();

            //Por cada pelicula, coger el Nombre, Categoria, ArchivoImagen y id
            foreach ($usuarios as $usuario) {

                //Conseguir la url de la imgen de la pelicula del disco

                $listaUsuarios[] = [
                    'username' => $usuario->username,
                    'password' => $usuario->password,
                    'id' => $usuario->id,
                    'type' => $usuario->type,
                    'ultima_busqueda' => $usuario->ultima_busqueda,
                ];
            }
        }

        return view('usuario.index', ['usuarios' => $listaUsuarios]);
    }

    public function create()
    {
        // Lógica para la vista del formulario de creación de películas
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        // Lógica para guardar la película en la base de datos

        // Comprobar que los datos del formulario son correctos
        $data = [
            'username' => 'required|regex:/^[A-Z][a-zA-Z0-9]{0,9}$/',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'Categoria' => 'required|string',
        ];

        $mensajes = [
            'username.regex' => 'El campo username debe comenzar con una letra mayúscula y tener como máximo 10 caracteres.',
            'password.regex' => 'El campo password debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.',
            // Otros mensajes de error según tus necesidades
        ];

        $validador = Validator::make($request->all(), $data, $mensajes);


        if ($request->isMethod('post') && $validador->fails() == false){


            // Crear un nuevo usuario
            $usuario = new Usuario();
            $usuario->username = $data['username'];
            $usuario->password = $data['password'];
            $usuario->type = $data['Categoria'];
            $usuario->ultima_busqueda = null;
            $usuario->save();

            return redirect()->route('usuario.index');
        }

        // Si la validación falla, redirigir al formulario de creación con los errores
        return redirect()->route('usuario.create')->withErrors($validador);
        
    }

    public function show($id)
    {
        // Tu lógica para mostrar la película con el ID proporcionado
        $usuario = Usuario::find($id);

        $datosUsuario = [
            'username' => $usuario->username,
            'password' => $usuario->password,
            'id' => $usuario->id,
            'type' => $usuario->type,
            'ultima_busqueda' => $usuario->ultima_busqueda,
        ];

        return view('usuario.show', ['usuario' => $datosUsuario]);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        // Lógica para eliminar la película con el ID proporcionado
        if ($usuario) {

            // Lógica para eliminar la película con el ID proporcionado
            $usuario->delete();
        }


        return redirect()->route('usuario.index');
    }
}
