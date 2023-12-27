<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfAcademica extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_universidad',
        'tipo_universidad_id',
        'anio_ingreso',
        'anio_egreso',
        'pais_id',
        'departamento',
        'provincia',
        'distrito',
        'distrito_estudio_id',
        'postulante_id',
        'grado_obtenido',
        'est_concluidos'
    ];

    public function postulante()
    {
        return $this->belongsTo(Postulante::class);
    }
}
