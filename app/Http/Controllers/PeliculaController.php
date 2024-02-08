<?php

namespace App\Http\Controllers;


use App\Models\Pelicula;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeliculaController extends Controller
{

    private $disk = 'public';

    public function index()
    {
        // Lógica para la vista del dashboard del administrador
        $listaPeliculas = [];

        //Coger los datos de las peliculas de la base de datos
        $peliculas = Pelicula::all();

        //Por cada pelicula, coger el Nombre, Categoria, ArchivoImagen y id
        foreach ($peliculas as $pelicula) {

            //Conseguir la url de la imgen de la pelicula del disco
            $rutaImagen = asset("storage/{$pelicula->ArchivoImagen}");
            $rutaVideo = asset("storage/{$pelicula->ArchivoVideo}");

            $listaPeliculas[] = [
                'Nombre' => $pelicula->Nombre,
                'Categoria' => $pelicula->Categoria,
                'ArchivoImagen' => $rutaImagen,
                'ArchivoVideo' => $rutaVideo,
                'id' => $pelicula->id,
            ];
        }

        return view('pelicula.index', ['peliculas' => $listaPeliculas]);
    }

    public function load(Request $request)
    {

        //Lógica para cargar las peliculas en la base de datos
        $listaPeliculas = [];

        //Si el metodo es post y el selector no es nulo
        if ($request->isMethod('post') && $request->input('selector') != null) {

            // Lógica para la vista del dashboard del administrador


            //Coger los datos de las peliculas de la base de datos
            $peliculas = Pelicula::where('Categoria', $request->input('selector'))->get();

            //Por cada pelicula, coger el Nombre, Categoria, ArchivoImagen y id
            foreach ($peliculas as $pelicula) {

                //Conseguir la url de la imgen de la pelicula del disco
                $rutaImagen = asset("storage/{$pelicula->ArchivoImagen}");
                $rutaVideo = asset("storage/{$pelicula->ArchivoVideo}");

                $listaPeliculas[] = [
                    'Nombre' => $pelicula->Nombre,
                    'Categoria' => $pelicula->Categoria,
                    'ArchivoImagen' => $rutaImagen,
                    'ArchivoVideo' => $rutaVideo,
                    'id' => $pelicula->id,
                ];
            }
        }

        return view('pelicula.index', ['peliculas' => $listaPeliculas]);
    }

    public function create()
    {
        // Lógica para la vista del formulario de creación de películas
        return view('pelicula.create');
    }

    public function store(Request $request)
    {
        // Lógica para guardar la película en la base de datos

        // Comprobar que los datos del formulario son correctos
        $data =  [
            'Nombre' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'Director' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'Duracion' => 'required|string|regex:/^\d{2}:\d{2}:\d{2}$/',
            'Categoria' => 'required|string',
            'ArchivoVideo' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'video' => 'required|mimes:mp4,avi,mov', // Ajusta las extensiones de archivo según tus necesidades
            'ArchivoImagen' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ajusta las extensiones de archivo según tus necesidades
        ];

        //Mensajes de error personalizados
        $mensajes = [
            'Nombre.regex' => 'El campo Título debe empezar por una letra mayúscula y contener solo letras sin números.',
            'Nombre.max' => 'El campo Título no puede tener más de 30 caracteres.',
            'Director.regex' => 'El campo Director debe empezar por una letra mayúscula y contener solo letras sin números.',
            'Director.max' => 'El campo Director no puede tener más de 30 caracteres.',
            'Duracion.regex' => 'El campo Duración debe tener el formato 00:00:00.',
            'Categoria.in' => 'Selecciona una categoría válida.',
            'ArchivoVideo.regex' => 'El campo Nombre del Video debe empezar por una letra mayúscula y contener solo letras sin números.',
            'ArchivoVideo.max' => 'El campo Nombre del Video no puede tener más de 30 caracteres.',
            'video.mimes' => 'El archivo de video debe ser de tipo mp4, mov o avi.',
            'ArchivoImagen.regex' => 'El campo Nombre de la Imagen debe empezar por una letra mayúscula y contener solo letras sin números.',
            'ArchivoImagen.max' => 'El campo Nombre de la Imagen no puede tener más de 30 caracteres.',
            'img.mimes' => 'El archivo de imagen debe ser de tipo jpeg, png, jpg o gif.',
        ];

        $validador = Validator::make($request->all(), $data, $mensajes);

        if ($request->isMethod('post') && $request->hasFile('img') && $request->hasFile('video') && $validador->fails() == false) {

            $fileImage = $request->file('img');
            $fileVideo = $request->file('video');

            $nombreImagen = $request->input('ArchivoImagen');
            $nombreVideo = $request->input('ArchivoVideo');

            //Añadir la extensión al nombre de la imagen y el video
            $nombreImagenBD = $nombreImagen . "." . $fileImage->extension();
            $nombreVideoBD = $nombreVideo . "." . $fileVideo->extension();

            //si ya existe una pelicula con ese nombre en el disco, añaadir un numero al final en $nombreImagenBD y $nombreVideoBD como en $nombreImagen y $nombreVideo
            $i = 1;
            while (Storage::disk($this->disk)->exists($nombreImagenBD)) {
                $nombreImagenBD = $nombreImagen . $i . "." . $fileImage->extension();
                $i++;
            }
            while (Storage::disk($this->disk)->exists($nombreVideoBD)) {
                $nombreVideoBD = $nombreVideo . $i . "." . $fileVideo->extension();
                $i++;
            }

            $fileImage->storeAs("", $nombreImagenBD, $this->disk);
            $fileVideo->storeAs("", $nombreVideoBD, $this->disk);


            // Crear una nueva película
            $pelicula = new Pelicula();
            $pelicula->Nombre = $request->input('Nombre');
            $pelicula->Categoria = $request->input('Categoria');
            $pelicula->Director = $request->input('Director');
            $pelicula->Duracion = $request->input('Duracion');
            $pelicula->ArchivoImagen = $nombreImagenBD;
            $pelicula->ArchivoVideo = $nombreVideoBD;
            $pelicula->save();

            return redirect()->route('pelicula.index');
        }

        // Redireccionar a la vista del formulario de creación de películas avisando de que ha habido un error en una ventana emergente
        return redirect()->route('pelicula.create')->withErrors($validador);
    }

    public function show($id)
    {
        // Tu lógica para mostrar la película con el ID proporcionado
        $pelicula = Pelicula::find($id);

        $rutaImagen = asset("storage/{$pelicula->ArchivoImagen}");
        $rutaVideo = asset("storage/{$pelicula->ArchivoVideo}");

        $datosPelicula = [
            'Nombre' => $pelicula->Nombre,
            'Categoria' => $pelicula->Categoria,
            'Director' => $pelicula->Director,
            'Duracion' => $pelicula->Duracion,
            'ArchivoImagen' => $rutaImagen,
            'ArchivoVideo' => $rutaVideo,
            'id' => $pelicula->id,
        ];

        return view('pelicula.show', ['pelicula' => $datosPelicula]);
    }

    public function destroy($id)
    {

        $pelicula = Pelicula::find($id);
        // Lógica para eliminar la película con el ID proporcionado
        if ($pelicula) {

            // Lógica para eliminar la película con el ID proporcionado
            $pelicula->delete();

            // Eliminar los archivos del disco
            Storage::disk($this->disk)->delete($pelicula->ArchivoImagen);
            Storage::disk($this->disk)->delete($pelicula->ArchivoVideo);
        }


        return redirect()->route('pelicula.index');
    }

    public function descargar($id)
    {
        // Lógica para descargar la película con el ID proporcionado
        $pelicula = Pelicula::find($id);

        //si la pelicula existe
        if ($pelicula) {
            //Coger el archivo de la pelicula del disco
            $rutaVideo = $pelicula->ArchivoVideo;

            //Usando el usuario la sesion, actualizamos la ultima_busqueda en la base de datos con el nombre de la pelicula de ese usuario
            $usuario = Usuario::find(session('user')['id']);
            $usuario->ultima_busqueda = $pelicula->Nombre;
            $usuario->save();

            //Descargar el archivo
            return response()->download(storage_path("app/public/{$rutaVideo}"));
        }

        return redirect()->route('pelicula.index');
    }
}
