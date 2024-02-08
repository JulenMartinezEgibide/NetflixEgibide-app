<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    use HasFactory;

    protected $fillable = ['Nombre_episodio', 'Descripcion', 'Duracion', 'ArchivoImagen', 'ArchivoVideo', 'serie_id'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
}
