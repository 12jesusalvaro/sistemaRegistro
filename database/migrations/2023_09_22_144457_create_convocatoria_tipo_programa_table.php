<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('convocatoria_tipo_programa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('convocatoria_id');
            $table->unsignedBigInteger('tipo_programa_id');
            $table->timestamps();

            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->onDelete('cascade');
            $table->foreign('tipo_programa_id')->references('id')->on('tipo_programas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('convocatoria_tipo_programa');
    }
};
