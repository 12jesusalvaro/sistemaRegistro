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
        Schema::create('puntajes', function (Blueprint $table) {
            $table->id();

            //ID de preinscipcion
            $table->unsignedBigInteger('postulante_id')->nullable();
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('set null')->onUpdate('cascade');

            //relation with porcentaje_notas
            $table->unsignedBigInteger('porcentaje_nota_id')->nullable();
            $table->foreign('porcentaje_nota_id')->references('id')->on('porcentaje_notas')->onDelete('set null')->onUpdate('cascade');

            $table->decimal('nota_cv', 10, 2)->nullable();
            $table->decimal('nota_proyecto', 10, 2)->nullable();
            $table->decimal('nota_crrn', 10, 2)->nullable();
            $table->decimal('nota_formacion', 10, 2)->nullable();
            $table->decimal('nota_idioma', 10, 2)->nullable();
            $table->decimal('nota_investigacion', 10, 2)->nullable();
            $table->decimal('nota_habilidades', 10, 2)->nullable();
            $table->decimal('nota_parcial1', 10, 2)->nullable();
            $table->decimal('nota_parcial2', 10, 2)->nullable();
            $table->decimal('nota_total', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntajes');
    }
};
