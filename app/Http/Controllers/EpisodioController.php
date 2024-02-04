<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EpisodioController extends Controller
{
    private $disk = 'public';

    public function create($id_serie)
    {
        return view('episodio.create', ['id_serie' => $id_serie]);
    }

    public function store(Request $request, $id_serie)
    {

        $datosEpisodio = [
            'Nombre' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'Duracion' => 'required|string|regex:/^\d{2}:\d{2}:\d{2}$/',
            'ArchivoVideo' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'video' => 'required|mimes:mp4,avi,mov', // Ajusta las extensiones de archivo según tus necesidades
            'ArchivoImagen' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ajusta las extensiones de archivo según tus necesidades
        ];

        $mensajes = [
            'Nombre.regex' => 'El campo Título debe empezar por una letra mayúscula y contener solo letras sin números.',
            'Nombre.max' => 'El campo Título no puede tener más de 30 caracteres.',
            'Duracion.regex' => 'El campo Duración debe tener el formato 00:00:00.',
            'ArchivoVideo.regex' => 'El campo Nombre del Video debe empezar por una letra mayúscula y contener solo letras sin números.',
            'ArchivoVideo.max' => 'El campo Nombre del Video no puede tener más de 30 caracteres.',
            'video.mimes' => 'El archivo de video debe ser de tipo mp4, mov o avi.',
            'ArchivoImagen.regex' => 'El campo Nombre de la Imagen debe empezar por una letra mayúscula y contener solo letras sin números.',
            'ArchivoImagen.max' => 'El campo Nombre de la Imagen no puede tener más de 30 caracteres.',
            'img.mimes' => 'El archivo de imagen debe ser de tipo jpeg, png, jpg o gif.',
        ];

        $validador = $request->validate($datosEpisodio, $mensajes);

        if ($request->isMethod('post') && $request->hasFile('video') && $request->hasFile('img') && $validador) {

            $fileImage = $request->file('img');
            $fileVideo = $request->file('video');

            $nombreImagen = $request->input('ArchivoImagen');
            $nombreVideo = $request->input('ArchivoVideo');

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


            $episodio = new Episodio();
            $episodio->Nombre_episodio = $request->input('Nombre');
            $episodio->Descripcion = $request->input('Descripcion');
            $episodio->Duracion = $request->input('Duracion');
            $episodio->ArchivoImagen = $nombreImagenBD;
            $episodio->ArchivoVideo = $nombreVideoBD;
            $episodio->serie_id = $id_serie;

            return redirect()->route('serie.index');
        }
    }

    public function show($id)
    {

        $episodio = Episodio::find($id);

        $serie = Serie::find($episodio->serie_id);

        $rutaImagen = asset("storage/{$episodio->ArchivoImagen}");
        $rutaVideo = asset("storage/{$episodio->ArchivoVideo}");

        $datosEpisodio = [
            'Nombre' => $episodio->Nombre_episodio,
            'Descripcion' => $episodio->Descripcion,
            'Duracion' => $episodio->Duracion,
            'ArchivoImagen' => $rutaImagen,
            'ArchivoVideo' => $rutaVideo,
            'id' => $episodio->id,
        ];

        return view('episodio.show', ['episodio' => $datosEpisodio, 'serie' => $serie]);
    }

    public function destroy($id)
    {

        $episodio = Episodio::find($id);

        if ($episodio) {

            $episodio->delete();

            Storage::disk($this->disk)->delete($episodio->ArchivoVideo);
        }


        return redirect()->route('pelicula.index');
    }

    public function descargar($id)
    {

        $episodio = Episodio::find($id);

        if ($episodio) {

            $rutaVideo = $episodio->ArchivoVideo;
            return response()->download(storage_path("app/public/{$rutaVideo}"));

            $usuario = Usuario::find(session('user')['id']);
            $usuario->ultima_busqueda = $episodio->Nombre_episodio;
            $usuario->save();
        }

        return redirect()->route('pelicula.index');
    }
}
