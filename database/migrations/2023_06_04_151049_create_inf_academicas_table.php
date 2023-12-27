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
        Schema::create('inf_academicas', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_universidad');
             //TIPO DE UNIVERSIDAD (INGR.)
            $table->unsignedBigInteger('tipo_universidad_id')->nullable();
            $table->foreign('tipo_universidad_id')->references('id')->on('tipo_universidads')->onDelete('set null')->onUpdate('cascade');
            //AÑO QUE INGRESÓ A LA UNIVERSIDAD
            $table->integer('anio_ingreso');
            //AÑO QUE EGRESO DE LA UNIVERSIDAD
            $table->integer('anio_egreso');

            //pais donde CULMINÓ SUS ESTUDIOS
            $table->unsignedBigInteger('pais_id')->nullable();
            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('set null')->onUpdate('cascade');

            //DEPARTAMENTO EGRESO DE LA UNIVERSIDAD
            $table->string('departamento',50)->nullable();
            //PROVINCIA EGRESO DE LA UNIVERSIDAD
            $table->string('provincia',50)->nullable();
            //DISTRITO EGRESO DE LA UNIVERSIDAD
            $table->string('distrito',50)->nullable();

            //distrito de universidad donde estudio
            $table->unsignedBigInteger('distrito_estudio_id')->nullable();
            $table->foreign('distrito_estudio_id')->references('id')->on('distritos')->onDelete('set null')->onUpdate('cascade');

            //id del postulante
            $table->unsignedBigInteger('postulante_id')->nullable();
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('set null')->onUpdate('cascade');

            //GRADO OBTENIDO
            $table->string('grado_obtenido',100);
            //ESTUDIOS CONCLUIDOS
            $table->string('est_concluidos',60);//ojo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inf_academicas');
    }
};
