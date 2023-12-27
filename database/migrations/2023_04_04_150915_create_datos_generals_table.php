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
        Schema::create('datos_generals', function (Blueprint $table) {
            $table->id();

            //Cantidad de apellidos
            //$table->unsignedBigInteger('cant_apellido_id')->nullable();
            //$table->foreign('cant_apellido_id')->references('id')->on('cant_apellidos')->onDelete('set null')->onUpdate('cascade');
            

            $table->date('fecha_nacimiento');
            $table->boolean('sexo');
            //pais de nacimiento
            $table->unsignedBigInteger('pais_nac_id')->nullable();
            $table->foreign('pais_nac_id')->references('id')->on('pais')->onDelete('set null')->onUpdate('cascade');
            //nacionalidad
            $table->unsignedBigInteger('nacionalidad_id')->nullable();
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidads')->onDelete('set null')->onUpdate('cascade');

            //distrito de nacimiento
            $table->unsignedBigInteger('distrito_nac_id')->nullable();
            $table->foreign('distrito_nac_id')->references('id')->on('distritos')->onDelete('set null')->onUpdate('cascade');

            $table->string('direccion_domiciliaria');
            $table->string('ubigeo_domicilio');
            $table->string('ubigeo_nacimiento');

            //distrito de domicilio
            $table->unsignedBigInteger('distrito_domic_id')->nullable();
            $table->foreign('distrito_domic_id')->references('id')->on('distritos')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('edad');

            //estado civil
            $table->unsignedBigInteger('estado_civil_id')->nullable();
            $table->foreign('estado_civil_id')->references('id')->on('estado_civils')->onDelete('set null')->onUpdate('cascade');

            //estado civil
            $table->unsignedBigInteger('discapacidad_id')->nullable();
            $table->foreign('discapacidad_id')->references('id')->on('discapacidads')->onDelete('set null')->onUpdate('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_generals');
    }
};
