<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Usuario;
use App\Models\Episodio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SerieController extends Controller
{
    
    private $disk = 'public';

    public function index()
    {

        $listaSeries = [];
        
        $series = Serie::all();

        
        foreach($series as $serie){

            
            $rutaImagen = asset("storage/{$serie->ArchivoImagen}");

            $listaSeries[] = [
                'Nombre' => $serie->Nombre_serie,
                'Categoria' => $serie->Categoria,
                'Director' => $serie->Director,
                'ArchivoImagen' => $rutaImagen,
                'id' => $serie->id,
            ];
        }

        return view('serie.index', ['series' => $listaSeries]);
    }

    public function load(Request $request){

        
        $listaSeries = [];

        
        if($request->isMethod('post') && $request->input('selector') != null){

            $series = Serie::where('Categoria', $request->input('selector'))->get();

            
            foreach($series as $serie){

                
                $rutaImagen = asset("storage/{$serie->ArchivoImagen}");

                $listaSeries[] = [
                    'Nombre' => $serie->Nombre_serie,
                    'Categoria' => $serie->Categoria,
                    'Director' => $serie->Director,
                    'ArchivoImagen' => $rutaImagen,
                    'id' => $serie->id,
                ];
            
            }
        }

        return view('serie.index', ['series' => $listaSeries]);
    }

    public function create()
    {
        return view('serie.create');
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'Nombre' => 'required|string',
            'Categoria' => 'required|string',
            'Director' => 'required|string',
            'ArchivoImagen' => 'required|string',
        ]);
        
        if($request->isMethod('post') && $request->hasFile('img')){
            $fileImage = $request->file('img');
            
            $nombreImagen = $request->input('ArchivoImagen');

            $fileImage->storeAs("", $nombreImagen.".".$fileImage->extension(), $this->disk);

            $nombreImagenBD = $nombreImagen.".".$fileImage->extension();

            $data = $request->validate([
                'Nombre' => 'required|string',
                'Categoria' => 'required|string',
                'Director' => 'required|string',
                'ArchivoImagen' => 'required|string',
            ]);
    
            
            $serie = new Serie();
            $serie->Nombre_serie = $data['Nombre'];
            $serie->Categoria = $data['Categoria'];
            $serie->Director = $data['Director'];
            $serie->ArchivoImagen = $nombreImagenBD;
            $serie->save();
            
            return redirect()->route('serie.index');
        }

       
        return redirect()->route('serie.create')->with('error', 'Error al crear la película');
        
    }

    public function show($id)
{
    
    $serie = Serie::find($id);

    $rutaImagen = asset("storage/{$serie->ArchivoImagen}");

    $datosSerie = [
        'Nombre' => $serie->Nombre_serie,
        'Categoria' => $serie->Categoria,
        'Director' => $serie->Director,
        'ArchivoImagen' => $rutaImagen,
        'id' => $serie->id,
    ];

    return view('serie.show', ['serie' => $datosSerie, 'episodios' => $serie->episodios]);
}

    public function destroy($id)
    {

        $serie = Serie::find($id);
        //$episodios = Episodio::where('id_serie', $id)->get();
        
        if ($serie) {

            $serie->delete();
    
            Storage::disk($this->disk)->delete($serie->ArchivoImagen);
            /*foreach($episodios as $episodio){
                Storage::disk($this->disk)->delete($episodio->ArchivoVideo);
            }*/
        }


        return redirect()->route('pelicula.index');
    }

    public function descargar($id){
       
        $serie = Serie::find($id);
        $episodios = Episodio::where('serie_id', $id)->get();
        
        if($serie){
        
            foreach($episodios as $episodio){
                $rutaVideo = $episodio->ArchivoVideo;
                return response()->download(storage_path("app/public/{$rutaVideo}"));
            }
            
            $usuario = Usuario::find(session('user')['id']);
            $usuario->ultima_busqueda = $serie->Nombre_serie;
            $usuario->save();

        }

        return redirect()->route('pelicula.index');
    }
}
