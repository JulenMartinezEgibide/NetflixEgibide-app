<?php

namespace App\Http\Controllers;


use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeliculaController extends Controller
{

    private $disk = 'public';

    public function index()
    {
        // Lógica para la vista del dashboard del administrador
        //Coger los datos de las peliculas de la base de datos
        $peliculas = Pelicula::all();

        $listaPeliculas = [];

        //Por cada pelicula, coger el Nombre, Categoria, ArchivoImagen y id
        foreach($peliculas as $pelicula){

            //Conseguir la imagen de la pelicula del disco
            $rutaImagen = asset(Storage::disk($this->disk)->get($pelicula->ArchivoImagen));

            $listaPeliculas[] = [
                'Nombre' => $pelicula->Nombre,
                'Categoria' => $pelicula->Categoria,
                'ArchivoImagen' => $rutaImagen,
                'id' => $pelicula->id,
            ];
        }



        //$archivoImagen = Storage::disk($this->disk)->get('peliculas.json');

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

        if($request->isMethod('post')) {
            $fileImage = $request->file('imagen');
            $fileVideo = $request->file('video');
            
            $nombreImagen = $request->input('imgName');
            $nombreVideo = $request->input('videoName');

            $fileImage->storeAs("", $nombreImagen.".".$fileImage->extension(), $this->disk);
            $fileVideo->storeAs("", $nombreVideo.".".$fileVideo->extension(), $this->disk);

            $nombreImagenBD = $nombreImagen.".".$fileImage->extension();
            $nombreVideoBD = $nombreVideo.".".$fileVideo->extension();

            $data = $request->validate([
                'Nombre' => 'required|string',
                'Categoria' => 'required|string',
                'Director' => 'required|string',
                'Duracion' => 'required|string',
                'ArchivoImagen' => 'required|string',
                'ArchivoVideo' => 'required|string',
            ]);
    
            // Crear un nuevo usuario
            $pelicula = new Pelicula();
            $pelicula->Nombre = $data['Nombre'];
            $pelicula->Categoria = $data['Categoria'];
            $pelicula->Director = $data['Director'];
            $pelicula->Duracion = $data['Duracion'];
            $pelicula->ArchivoImagen = $nombreImagenBD;
            $pelicula->ArchivoVideo = $nombreVideoBD;
            $pelicula->save();

        }

        return redirect()->route('admin.pelicula.index');
    }
}
