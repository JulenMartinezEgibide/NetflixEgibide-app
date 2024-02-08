<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //generar usuario con usuario y contraseña admin usando modelo usuario

        \App\Models\Usuario::create([
            'username' => 'admin',
            'password' => 'admin', // Puedes cambiar la contraseña según tus preferencias
            'type' => 'Admin',
        ]);

        //generar usuario con usuario y contraseña alumno usando modelo usuario

        \App\Models\Usuario::create([
            'username' => 'alumno',
            'password' => 'alumno', // Puedes cambiar la contraseña según tus preferencias
            'type' => 'Alumno',
        ]);

        //generar 10 usuarios con type alumno usando modelo usuario

        \App\Models\Usuario::factory(10)->create([
            'type' => 'Alumno',
        ]);

        //generar 10 usuarios con type admin usando modelo usuario

        \App\Models\Usuario::factory(10)->create([
            'type' => 'Admin',
        ]);
            
    }
}
