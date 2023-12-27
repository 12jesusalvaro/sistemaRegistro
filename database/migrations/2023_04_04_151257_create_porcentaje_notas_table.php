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
        Schema::create('porcentaje_notas', function (Blueprint $table) {
            $table->id();
            $table->integer('nota_1')->nullable();
            $table->integer('nota_2')->nullable();
            $table->integer('nota_3')->nullable();
            $table->integer('nota_4')->nullable();
            $table->integer('nota_5')->nullable();
            $table->integer('nota_6')->nullable();
            $table->integer('nota_7')->nullable();

            //relation with tipo_programa(maestria, doctorado)
            $table->unsignedBigInteger('tipo_programa_id')->nullable();
            $table->foreign('tipo_programa_id')->references('id')->on('tipo_programas')->onDelete('set null')->onUpdate('cascade');

            //relation with convocatoria
            $table->unsignedBigInteger('convocatoria_id')->nullable();
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porcentaje_notas');
    }
};
