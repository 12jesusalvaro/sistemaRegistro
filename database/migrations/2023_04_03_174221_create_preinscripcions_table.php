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
        Schema::create('preinscripcions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('mencion_id')->nullable();
            $table->foreign('mencion_id')->references('id')->on('mencions')->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('pago_inscripcion_id')->nullable();
            $table->foreign('pago_inscripcion_id')->references('id')->on('pago_inscripcions')->onDelete('set null')->onUpdate('cascade');

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
        Schema::dropIfExists('preinscripcions');
    }
};
