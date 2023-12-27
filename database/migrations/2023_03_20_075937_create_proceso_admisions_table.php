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
        Schema::create('proceso_admisions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');

            $table->unsignedBigInteger('modalidad_estudio_id')->nullable();
            $table->foreign('modalidad_estudio_id')->references('id')->on('modalidad_estudios')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('filial_id')->nullable();
            $table->foreign('filial_id')->references('id')->on('filials')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('modalidad_admision_id')->nullable();
            $table->foreign('modalidad_admision_id')->references('id')->on('modalidad_admisions')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('tipo_proceso_id')->nullable();
            $table->foreign('tipo_proceso_id')->references('id')->on('tipo_procesos')->onDelete('set null')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proceso_admisions');
    }
};
