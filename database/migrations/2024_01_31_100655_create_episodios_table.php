<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('episodios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('serie_id')->constrained()->cascadeOnDelete(); // Relación con la serie a la que pertenece el episodio
            $table->string('Nombre_episodio');
            $table->string('Descripcion');
            $table->string('Duracion');
            $table->string('ArchivoVideo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodios');
    }
};
