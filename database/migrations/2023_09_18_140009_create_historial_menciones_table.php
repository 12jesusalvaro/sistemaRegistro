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
        Schema::create('historial_menciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mencion_id')->nullable();
            $table->foreign('mencion_id')->references('id')->on('mencions')->onUpdate('cascade')->onDelete('set null');

            $table->unsignedBigInteger('convocatoria_id')->nullable();
            $table->foreign('convocatoria_id')->references('id')->on('convocatorias')->onUpdate('cascade')->onDelete('set null');

            $table->decimal('costo', 10, 2)->nullable(); // Ajusta el tipo y precisión según tus necesidades
            $table->integer('vacantes')->nullable();
            $table->timestamps();



        });
    }

    public function down()
    {
        Schema::dropIfExists('historial_menciones');
    }
};
