<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoPago extends Model
{
    use HasFactory;

    protected $table = 'codigo_pagos';
    protected $fillable = [
        'codigo',
        'estado',
    ];

    public function pagosInscripcion()
    {
        return $this->hasMany(PagoInscripcion::class, 'codigo_pagos_id');
    }

}
