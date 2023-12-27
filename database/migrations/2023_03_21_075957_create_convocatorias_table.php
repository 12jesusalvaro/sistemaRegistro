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
        Schema::create('convocatorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('anio');
            $table->unsignedBigInteger('numero');

            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_final');
            $table->timestamp('fecha_inicio_carga');
            $table->timestamp('fecha_fin_carga');

            //tipo de programa como doctorado, maestrias otros
            //$table->unsignedBigInteger('tipo_programa_id')->nullable();
            //$table->foreign('tipo_programa_id')->references('id')->on('tipo_programas')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('proceso_admision_id')->nullable();
            $table->foreign('proceso_admision_id')->references('id')->on('proceso_admisions')->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convocatorias');
    }
};
