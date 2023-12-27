<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
    use HasFactory;
    protected $table = 'convocatorias';
    protected $fillable = [

        'nombre',
        'anio',
        'numero',
        'fecha_inicio',
        'fecha_final',
        'fecha_inicio_carga',
        'fecha_fin_carga',
        'proceso_admision_id'

    ];

    public function preinscripciones()
    {
        return $this->hasMany(Preinscripcion::class);
    }

    public function postulantes()
    {
        return $this->hasManyThrough(Postulante::class, Preinscripcion::class);
    }

    public function procesoAdmision()
    {
        return $this->belongsTo(ProcesoAdmision::class);
    }

    public function tipoProgramas()
    {
        return $this->belongsToMany(TipoPrograma::class, 'convocatoria_tipo_programa');
    }

}
