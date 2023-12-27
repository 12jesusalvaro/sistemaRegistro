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
        Schema::create('postulantes', function (Blueprint $table) {
            $table->id();

            //ID de preinscipcion
            $table->unsignedBigInteger('preinscripcion_id')->nullable();
            $table->foreign('preinscripcion_id')->references('id')->on('preinscripcions')->onDelete('cascade')->onUpdate('cascade');


            //I. DATOS GENERALES POSTULANTE
            $table->unsignedBigInteger('datos_general_id')->nullable();
            $table->foreign('datos_general_id')->references('id')->on('datos_generals')->onDelete('set null')->onUpdate('cascade');
            //II. INFORMACIÓN ACADÉMICA-> (PARA POSTULANTES A DOCTORADO)
            //$table->unsignedBigInteger('inf_academica_id')->nullable();
            //$table->foreign('inf_academica_id')->references('id')->on('inf_academicas')->onDelete('set null')->onUpdate('cascade');
            //III. EXPERIENCIA PROFESIONAL
            $table->unsignedBigInteger('exp_profesional_id')->nullable();
            $table->foreign('exp_profesional_id')->references('id')->on('exp_profesionals')->onDelete('set null')->onUpdate('cascade');
            //IV. PRODUCCIÓN CIENTÍFICA
            //$table->unsignedBigInteger('prod_cientifica_id')->nullable();
            //$table->foreign('prod_cientifica_id')->references('id')->on('prod_cientificas')->onDelete('set null')->onUpdate('cascade');
            //V. IDIOMAS EXTRANJEROS Y NATIVOS
            //$table->unsignedBigInteger('idioma_id')->nullable();
            //$table->foreign('idioma_id')->references('id')->on('idiomas')->onDelete('set null')->onUpdate('cascade');
            //VI. ARCHIVOS POSTULANTES
            //$table->unsignedBigInteger('archivo_postulante_id')->nullable();
            //$table->foreign('archivo_postulante_id')->references('id')->on('archivo_postulantes')->onDelete('set null')->onUpdate('cascade');

            //relation with convocatoria
            $table->unsignedBigInteger('convocatoria_id')->nullable();
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->onDelete('set null')->onUpdate('cascade');

            $table->integer('current_step')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postulantes');
    }
};
