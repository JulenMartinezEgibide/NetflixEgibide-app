<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    
    protected $fillable = ['Nombre_serie', 'Categoria', 'Director', 'ArchivoImagen'];

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }
}
