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
        Schema::create('exp_profesionals', function (Blueprint $table) {

            $table->id();
            //Registre la institución de procedencia
            $table->string('inst_procedencia');

            //Cargo actual en la institución
            $table->string('carg_actual');

            //Fecha de inicio en su institución
            $table->date('fecha_inicio');

            //Otros
            $table->string('otros');

            //Código de otroinscripción
            $table->string('codigo_otro_inscripcion');

            //Código ORCID
            $table->string('cod_orcid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exp_profesionals');
    }
};
