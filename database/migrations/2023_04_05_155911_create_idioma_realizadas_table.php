<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //LISTA DE IDIOMAS REALIZADAS
    public function up(): void
    {
        Schema::create('idioma_realizadas', function (Blueprint $table) {
            $table->id();

            //LISTA DE IDIOMAS
            $table->unsignedBigInteger('list_idioma_id')->nullable();
            $table->foreign('list_idioma_id')->references('id')->on('list_idiomas')->onDelete('set null')->onUpdate('cascade');
            //HABLA
            $table->unsignedBigInteger('habla_id')->nullable();
            $table->foreign('habla_id')->references('id')->on('escala_valorativas')->onDelete('set null')->onUpdate('cascade');
            //LEE
            $table->unsignedBigInteger('lee_id')->nullable();
            $table->foreign('lee_id')->references('id')->on('escala_valorativas')->onDelete('set null')->onUpdate('cascade');
            //ESCRIBE
            $table->unsignedBigInteger('escribe_id')->nullable();
            $table->foreign('escribe_id')->references('id')->on('escala_valorativas')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('idioma_realizadas');
    }
};
