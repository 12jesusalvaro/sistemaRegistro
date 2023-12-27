<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('programa_estudios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); // maestria en robotica ejemplo
            $table->string('codigo',10);
            $table->float('monto');//costo de preinscripcion

            //$table->unsignedBigInteger('facultad_id')->unique()->nullable();
            //$table->foreign('facultad_id')->references('id')->on('facultads')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('mencion_id')->nullable();
            $table->foreign('mencion_id')->references('id')->on('mencions')->onDelete('set null')->onUpdate('cascade');





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa_estudios');
    }
};
