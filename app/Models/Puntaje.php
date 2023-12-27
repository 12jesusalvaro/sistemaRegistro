<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{
    use HasFactory;

    protected $fillable = [
        'postulante_id',
        'nota_cv',
        'nota_proyecto',
        'nota_crrn',
        'nota_formacion',
        'nota_idioma',
        'nota_investigacion',
        'nota_habilidades',
        'nota_total',
    ];

    // Relación con la tabla "postulantes"
    public function postulante()
    {
        return $this->belongsTo(Postulante::class);
    }

    public function porcentajeNota()
    {
        return $this->belongsTo(PorcentajeNota::class);
    }

}
