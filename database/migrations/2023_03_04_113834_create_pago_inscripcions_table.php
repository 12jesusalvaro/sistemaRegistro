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
        Schema::create('pago_inscripcions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_pago')->nullable();
            $table->string('numero_operacion', 25)->nullable();
            $table->float('monto')->nullable();

            $table->unsignedBigInteger('codigo_pagos_id')->nullable();
            $table->foreign('codigo_pagos_id')->references('id')->on('codigo_pagos')->onDelete('set null')->onUpdate('cascade');

            $table->boolean('estado_pago')->nullable();// condicionar o falso

            $table->string('voucher_pago', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago_inscripcions');
    }
};
