<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\Serie::create([
            'Nombre_serie' => 'Juego de Tronos',
            'Categoria' => 'Fantasia',
            'Director' => 'David Benioff',
            'ArchivoImagen' => 'Juegotronos.jpg',
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Invierno',
            'Descripcion' => 'Se acerca el invierno',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Juegotronos - copia.jpg',
            'ArchivoVideo' => 'juegotronos1.mp4',
            'serie_id' => 1,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El camino real',
            'Descripcion' => 'El camino real',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Juegotronos - copia (2).jpg',
            'ArchivoVideo' => 'juegotronos1 - copia.mp4',
            'serie_id' => 1,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Se acerca el invierno',
            'Descripcion' => 'Se acerca el invierno',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Juegotronos - copia (3).jpg',
            'ArchivoVideo' => 'juegotronos1 - copia (2).mp4',
            'serie_id' => 1,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El lobo y el leon',
            'Descripcion' => 'El lobo y el leon',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Juegotronos - copia (4).jpg',
            'ArchivoVideo' => 'juegotronos1 - copia (3).mp4',
            'serie_id' => 1,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Una corona de oro',
            'Descripcion' => 'Una corona de oro',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Juegotronos - copia (5).jpg',
            'ArchivoVideo' => 'juegotronos1 - copia (4).mp4',
            'serie_id' => 1,
        ]);

        \App\Models\Serie::create([
            'Nombre_serie' => 'The mandalorian',
            'Categoria' => 'Ciencia Ficcion',
            'Director' => 'Jon Favreau',
            'ArchivoImagen' => 'mandalorian.jpg',
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El mandaloriano',
            'Descripcion' => 'El mandaloriano',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'mandalorian - copia.jpg',
            'ArchivoVideo' => 'mandalorian.mp4',
            'serie_id' => 2,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El niño',
            'Descripcion' => 'El niño',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'mandalorian - copia (2).jpg',
            'ArchivoVideo' => 'mandalorian - copia.mp4',
            'serie_id' => 2,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El pecado',
            'Descripcion' => 'El pecado',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'mandalorian - copia (3).jpg',
            'ArchivoVideo' => 'mandalorian - copia (2).mp4',
            'serie_id' => 2,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El santuario',
            'Descripcion' => 'El santuario',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'mandalorian - copia (4).jpg',
            'ArchivoVideo' => 'mandalorian - copia (3).mp4',
            'serie_id' => 2,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El asedio',
            'Descripcion' => 'El asedio',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'mandalorian - copia (5).jpg',
            'ArchivoVideo' => 'mandalorian - copia (4).mp4',
            'serie_id' => 2,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El creyente',
            'Descripcion' => 'El creyente',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'mandalorian - copia (6).jpg',
            'ArchivoVideo' => 'mandalorian - copia (5).mp4',
            'serie_id' => 2,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El trono',
            'Descripcion' => 'El trono',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'mandalorian - copia (7).jpg',
            'ArchivoVideo' => 'mandalorian - copia (6).mp4',
            'serie_id' => 2,
        ]);

        \App\Models\Serie::create([
            'Nombre_serie' => 'The Walking Dead',
            'Categoria' => 'Terror',
            'Director' => 'Frank Darabont',
            'ArchivoImagen' => 'the-walking-dead.jpg',
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Dias pasados',
            'Descripcion' => 'Dias pasados',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'the-walking-dead - copia.jpg',
            'ArchivoVideo' => 'walking.mp4',
            'serie_id' => 3,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Tripas',
            'Descripcion' => 'Tripas',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'the-walking-dead - copia (2).jpg',
            'ArchivoVideo' => 'walking - copia.mp4',
            'serie_id' => 3,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Dile',
            'Descripcion' => 'Dile',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'the-walking-dead - copia (3).jpg',
            'ArchivoVideo' => 'walking - copia (2).mp4',
            'serie_id' => 3,
        ]);

        \App\Models\Serie::create([
            'Nombre_serie' => 'Fisica o Quimica',
            'Categoria' => 'Drama',
            'Director' => 'Carlos Montero',
            'ArchivoImagen' => 'Fisica.jpg',
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El principio',
            'Descripcion' => 'El principio',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Fisica - copia.jpg',
            'ArchivoVideo' => 'Fisica.mp4',
            'serie_id' => 4,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El amor',
            'Descripcion' => 'El amor',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Fisica - copia (2).jpg',
            'ArchivoVideo' => 'Fisica - copia.mp4',
            'serie_id' => 4,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El sexo',
            'Descripcion' => 'El sexo',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Fisica - copia (3).jpg',
            'ArchivoVideo' => 'Fisica - copia (2).mp4',
            'serie_id' => 4,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El amor',
            'Descripcion' => 'El amor',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Fisica - copia (4).jpg',
            'ArchivoVideo' => 'Fisica - copia (3).mp4',
            'serie_id' => 4,
        ]);
        
        \App\Models\Serie::create([
            'Nombre_serie' => 'Scooby Doo',
            'Categoria' => 'Aventuras',
            'Director' => 'Joe Ruby',
            'ArchivoImagen' => 'scooby.jpg',
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El misterio',
            'Descripcion' => 'El misterio',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'scooby - copia.jpg',
            'ArchivoVideo' => 'scooby.mp4',
            'serie_id' => 5,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Susurro',
            'Descripcion' => 'Susurro',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'scooby - copia (2).jpg',
            'ArchivoVideo' => 'scooby - copia.mp4',
            'serie_id' => 5,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El secreto',
            'Descripcion' => 'El secreto',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'scooby - copia (3).jpg',
            'ArchivoVideo' => 'scooby - copia (2).mp4',
            'serie_id' => 5,
        ]);

        \App\Models\Serie::create([
            'Nombre_serie' => 'La casa de papel',
            'Categoria' => 'Drama',
            'Director' => 'Alex Pina',
            'ArchivoImagen' => 'casapapel.jpg',
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El atraco',
            'Descripcion' => 'El atraco',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'casapapel - copia.jpg',
            'ArchivoVideo' => 'casapapel.mp4',
            'serie_id' => 6,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El golpe',
            'Descripcion' => 'El golpe',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'casapapel - copia (2).jpg',
            'ArchivoVideo' => 'casapapel - copia.mp4',
            'serie_id' => 6,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El golpe',
            'Descripcion' => 'El golpe',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'casapapel - copia (3).jpg',
            'ArchivoVideo' => 'casapapel - copia (2).mp4',
            'serie_id' => 6,
        ]);

        \App\Models\Serie::create([
            'Nombre_serie' => 'Halo',
            'Categoria' => 'Ciencia Ficcion',
            'Director' => 'Steven Spielberg',
            'ArchivoImagen' => 'Halo.jpg',
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'El comienzo',
            'Descripcion' => 'El comienzo',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Halo - copia.jpg',
            'ArchivoVideo' => 'Halo.mp4',
            'serie_id' => 7,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Entrenamiento',
            'Descripcion' => 'Entrenamiento',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Halo - copia (2).jpg',
            'ArchivoVideo' => 'Halo - copia.mp4',
            'serie_id' => 7,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Reclutamiento',
            'Descripcion' => 'Reclutamiento',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Halo - copia (3).jpg',
            'ArchivoVideo' => 'Halo - copia (2).mp4',
            'serie_id' => 7,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Contacto',
            'Descripcion' => 'Contacto',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Halo - copia (4).jpg',
            'ArchivoVideo' => 'Halo - copia (3).mp4',
            'serie_id' => 7,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Contrato',
            'Descripcion' => 'Contrato',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Halo - copia (5).jpg',
            'ArchivoVideo' => 'Halo - copia (4).mp4',
            'serie_id' => 7,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Batalla',
            'Descripcion' => 'Batalla',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Halo - copia (6).jpg',
            'ArchivoVideo' => 'Halo - copia (5).mp4',
            'serie_id' => 7,
        ]);

        \App\Models\Episodio::create([
            'Nombre_episodio' => 'Nueva era',
            'Descripcion' => 'Nueva era',
            'Duracion' => '01:30:00',
            'ArchivoImagen' => 'Halo - copia (7).jpg',
            'ArchivoVideo' => 'Halo - copia (6).mp4',
            'serie_id' => 7,
        ]);

    }
}
