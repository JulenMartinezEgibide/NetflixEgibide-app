<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeliculasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //generar peliculas usando modelo pelicula, teniendo en cuenta las imagenes y videos que se encuentran en la carpeta storage/app/public

        \App\Models\Pelicula::create([
            'Nombre' => 'Caza Fantasmas',
            'Director' => 'Ivan Reitman',
            'Duracion' => '01:30:00',
            'Categoria' => 'Comedia',
            'ArchivoImagen' => 'Cazafantasmas.jpg',
            'ArchivoVideo' => 'Cazafantasmas.mp4',
        ]);

        \App\Models\Pelicula::create([
            'Nombre' => 'Chuky',
            'Director' => 'Tom Holland',
            'Duracion' => '01:30:00',
            'Categoria' => 'Terror',
            'ArchivoImagen' => 'Chuky.jpg',
            'ArchivoVideo' => 'Chuky.mp4',
        ]);

        \App\Models\Pelicula::create([
            'Nombre' => 'Diablo',
            'Director' => 'Guillermo del Toro',
            'Duracion' => '01:30:00',
            'Categoria' => 'Terror',
            'ArchivoImagen' => 'Diablo.jpg',
            'ArchivoVideo' => 'Diablo.mp4',
        ]);

        \App\Models\Pelicula::create([
            'Nombre' => 'Openhaimer',
            'Director' => 'Steven Spielberg',
            'Duracion' => '01:30:00',
            'Categoria' => 'Drama',
            'ArchivoImagen' => 'Openhaimer.jpg',
            'ArchivoVideo' => 'Openhaimer.mp4',
        ]);

        \App\Models\Pelicula::create([
            'Nombre' => 'Patos',
            'Director' => 'George Lucas',
            'Duracion' => '01:30:00',
            'Categoria' => 'Aventuras',
            'ArchivoImagen' => 'Patos.jpg',
            'ArchivoVideo' => 'Patos.mp4',
        ]);

        \App\Models\Pelicula::create([
            'Nombre' => 'Regreso al Futuro',
            'Director' => 'Robert Zemeckis',
            'Duracion' => '01:30:00',
            'Categoria' => 'Ciencia Ficcion',
            'ArchivoImagen' => 'RegresoFuturo.jpg',
            'ArchivoVideo' => 'RegresoFuturo.mp4',
        ]);

        \App\Models\Pelicula::create([
            'Nombre' => 'Star Wars',
            'Director' => 'George Lucas',
            'Duracion' => '01:30:00',
            'Categoria' => 'Ciencia Ficcion',
            'ArchivoImagen' => 'StarWars.jpg',
            'ArchivoVideo' => 'StarWars.mp4',
        ]);

        \App\Models\Pelicula::create([
            'Nombre' => 'Todos menos tu',
            'Director' => 'George Lucas',
            'Duracion' => '01:30:00',
            'Categoria' => 'Romance',
            'ArchivoImagen' => 'Todostu.jpg',
            'ArchivoVideo' => 'Todostu.mp4',
        ]);


    }
}
