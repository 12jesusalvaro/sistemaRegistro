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
        Schema::create('archivo_postulantes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->unsignedBigInteger('postulante_id')->nullable();//user_id
            $table->foreign('postulante_id')->references('id')->on('postulantes')->onDelete('set null')->onUpdate('cascade');
            //user_id  -> id  ->  user
            $table->timestamps();//user_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archivo_postulantes');
    }
};
