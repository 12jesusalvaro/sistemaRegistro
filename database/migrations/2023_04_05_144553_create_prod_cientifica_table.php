<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //PRODUCCIÓN CIENTÍFICA REALIZADAS
    public function up(): void
    {
        Schema::create('prod_cientifica', function (Blueprint $table) {
            $table->id();
            //TITULO DE TRABAJO
            $table->string('titulo',120);
            //NOMBRE DE LA REVISTA O PUBLICACIÓN
            $table->string('nombre',120);
            //AÑO (PUBLICACION)
            $table->integer('anio');
            //NÚMERO (PUBLIC)
            $table->integer('numero');
            //VOLUMEN (PUBLIC 1)
            $table->string('volumen',50);
            //PÁGINAS DE: (PUBLIC)
            $table->integer('paginas');
            //A: (PUBLIC 1)
            $table->integer('hasta_pag');
            //id del postulante
            $table->unsignedBigInteger('postulante_id')->nullable();
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_cientifica');
    }
};
