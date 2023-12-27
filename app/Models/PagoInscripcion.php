<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PagoInscripcion extends Model
{
    use HasFactory;

    protected $table = 'pago_inscripcions'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'fecha_pago',
        'numero_operacion',
        'monto',
        'codigo_pagos_id',
        'estado_pago',
        'voucher_pago',
    ];

    public function codigoPago()
    {
        return $this->belongsTo(CodigoPago::class, 'codigo_pagos_id');
    }

    public function preinscripciones()
    {
        return $this->hasMany(Preinscripcion::class);
    }
}
