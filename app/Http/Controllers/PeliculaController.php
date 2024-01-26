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

        if($request->isMethod('post') && $request->hasFile('img') && $request->hasFile('video')){
            $fileImage = $request->file('img');
            $fileVideo = $request->file('video');
            
            $nombreImagen = $request->input('ArchivoImagen');
            $nombreVideo = $request->input('ArchivoVideo');

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
            
            return redirect()->route('admin.pelicula.index');
        }

        return redirect()->route('admin.pelicula.create');
        
    }
}
