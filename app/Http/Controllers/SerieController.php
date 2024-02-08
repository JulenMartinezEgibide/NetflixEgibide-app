<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Usuario;
use App\Models\Episodio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SerieController extends Controller
{

    private $disk = 'public';

    public function index()
    {

        $listaSeries = [];

        $series = Serie::all();


        foreach ($series as $serie) {


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

    public function load(Request $request)
    {


        $listaSeries = [];


        if ($request->isMethod('post') && $request->input('selector') != null) {

            $series = Serie::where('Categoria', $request->input('selector'))->get();


            foreach ($series as $serie) {


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

        $data = [
            'Nombre' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'Director' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'Categoria' => 'required|string',
            'ArchivoImagen' => 'required|string|max:30|regex:/^[A-Z][a-zA-Z\s]+$/',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ajusta las extensiones de archivo según tus necesidades
        ];

        $mensajes = [
            'Nombre.regex' => 'El campo Título debe empezar por una letra mayúscula y contener solo letras sin números.',
            'Nombre.max' => 'El campo Título no puede tener más de 30 caracteres.',
            'Director.regex' => 'El campo Director debe empezar por una letra mayúscula y contener solo letras sin números.',
            'Director.max' => 'El campo Director no puede tener más de 30 caracteres.',
            'Categoria.in' => 'Selecciona una categoría válida.',
            'ArchivoImagen.regex' => 'El campo Nombre de la Imagen debe empezar por una letra mayúscula y contener solo letras sin números.',
            'ArchivoImagen.max' => 'El campo Nombre de la Imagen no puede tener más de 30 caracteres.',
            'img.mimes' => 'El archivo de imagen debe ser de tipo jpeg, png, jpg o gif.',
        ];

        $validador = Validator::make($request->all(), $data, $mensajes);

        if ($request->isMethod('post') && $request->hasFile('img') && $validador->fails() == false) {
            $fileImage = $request->file('img');

            $nombreImagen = $request->input('ArchivoImagen');

            $nombreImagenBD = $nombreImagen . "." . $fileImage->extension();

            $i = 1;
            while (Storage::disk($this->disk)->exists($nombreImagenBD)) {
                $nombreImagenBD = $nombreImagen . $i . "." . $fileImage->extension();
                $i++;
            }

            $fileImage->storeAs("", $nombreImagenBD, $this->disk);


            $serie = new Serie();
            $serie->Nombre_serie = $request->input('Nombre');
            $serie->Categoria = $request->input('Categoria');
            $serie->Director = $request->input('Director');
            $serie->ArchivoImagen = $nombreImagenBD;
            $serie->save();

            return redirect()->route('serie.index');
        }


        return redirect()->route('serie.create')->withErrors($validador);
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
        $episodios = Episodio::all()->where('serie_id', $id);

        if ($serie) {

            $serie->delete();

            Storage::disk($this->disk)->delete($serie->ArchivoImagen);
            foreach($episodios as $episodio){
                Storage::disk($this->disk)->delete($episodio->ArchivoImagen);
                Storage::disk($this->disk)->delete($episodio->ArchivoVideo);
            }
        }


        return redirect()->route('serie.index');
    }

    public function descargar($id)
    {

        //Descargar todos los episodios de la serie con el ID proporcionado
        $serie = Serie::find($id);
        $episodios = Episodio::all()->where('serie_id', $id);

        if ($serie) {

            $usuario = Usuario::find(session('user')['id']);
            $usuario->ultima_busqueda = $serie->Nombre_serie;
            $usuario->save();

            $zip = new \ZipArchive();
            $zipFileName = $serie->Nombre_serie . ".zip";
            $zip->open($zipFileName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            foreach ($episodios as $episodio) {
                $rutaVideo = $episodio->ArchivoVideo;
                $zip->addFile(storage_path("app/public/{$rutaVideo}"), $episodio->Nombre_episodio . ".mp4");
            }

            $zip->close();

            return response()->download($zipFileName)->deleteFileAfterSend(true);
            
            //Borrar el archivo zip en la carpeta public
            unlink($zipFileName);


        }

        

        return redirect()->route('serie.index');
    }
}
