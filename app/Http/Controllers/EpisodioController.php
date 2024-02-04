<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Usuario;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EpisodioController extends Controller
{
    private $disk = 'public';

    public function create($id_serie)
    {
        return view('episodio.create', ['id_serie' => $id_serie]);
    }

    public function store(Request $request, $id_serie)
    {
        
        try {
            $datosEpisodio = $request->validate([
                'Nombre' => 'required|string|max:255',
                'Descripcion' => 'required|string|max:255',
                'Duracion' => 'required|string|max:255',
                'ArchivoImagen' => 'required|string|max:255',
                'ArchivoVideo' => 'required|string|max:255',
                'video' => 'required|file|mimes:mp4',
            ]);

            if($request->isMethod('post') && $request->hasFile('video') && $request->hasFile('img')){

                $fileImg = $request->file('img');
                $fileVideo = $request->file('video');
                
                $nombreImg = $request->input('ArchivoImagen');
                $nombreVideo = $request->input('ArchivoVideo');
    
                $fileImg->storeAs("", $nombreImg.".".$fileImg->extension(), $this->disk);
                $fileVideo->storeAs("", $nombreVideo.".".$fileVideo->extension(), $this->disk);
    
                $nombreImgBD = $nombreImg.".".$fileImg->extension();
                $nombreVideoBD = $nombreVideo.".".$fileVideo->extension();
    
        
                $episodio = new Episodio();
                $episodio->Nombre_episodio = $datosEpisodio['Nombre'];
                $episodio->Descripcion = $datosEpisodio['Descripcion'];
                $episodio->Duracion = $datosEpisodio['Duracion'];
                $episodio->ArchivoImagen = $nombreImgBD;
                $episodio->ArchivoVideo = $nombreVideoBD;
                $episodio->serie_id = $id_serie;
                $episodio->save();

                return redirect()->route('serie.index');
            }

        } catch (ValidationException $e) {
            // Manejar los errores aquí
            $errors = $e->errors();
    
            // Puedes hacer algo con los errores, como loggearlos o devolverlos a la vista
            return redirect()->back()->withErrors($errors)->withInput();
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

    public function descargar($id){
       
        $episodio = Episodio::find($id);
        
        if($episodio){
        
            $rutaVideo = $episodio->ArchivoVideo;
            return response()->download(storage_path("app/public/{$rutaVideo}"));
            
            $usuario = Usuario::find(session('user')['id']);
            $usuario->ultima_busqueda = $episodio->Nombre_episodio;
            $usuario->save();

        }

        return redirect()->route('pelicula.index');
    }
}
