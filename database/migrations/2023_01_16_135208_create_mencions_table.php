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
        Schema::create('mencions', function (Blueprint $table) {
            $table->id();
            //LISTA DE ESCUELAS
            $table->string('codigo')->nullable();
            $table->string('nombre');
            $table->boolean('active')->default(true);
            $table->unsignedBigInteger('programa_id')->nullable();
            $table->foreign('programa_id')->references('id')->on('programas')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('vacantes');
            $table->decimal('monto', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mencions');
    }
};
