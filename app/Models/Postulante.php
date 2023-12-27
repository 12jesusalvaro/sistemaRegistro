<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Postulante extends Model
{
    use HasFactory;

    protected $fillable = [
        'preinscripcion_id',
        'datos_general_id',
        'inf_academica_id',
        'exp_profesional_id',
        'prod_cientifica_id',
        'idioma_id',
        'archivo_postulante_id',
        'current_step'
    ];

    public function preinscripcion()
    {
        return $this->belongsTo(Preinscripcion::class);
    }

    public function datosGeneral()
    {
        return $this->belongsTo(DatosGeneral::class);
    }

    public function infAcademicas()
    {
        return $this->hasMany(InfAcademica::class);
    }

    public function expProfesional()
    {
        return $this->belongsTo(ExpProfesional::class);
    }

    public function prodCientifica()
    {
        return $this->hasMany(ProdCientifica::class);
    }

    public function idioma()
    {
        return $this->hasMany(Idioma::class);
    }

    public function archivoPostulante()
    {
        return $this->belongsTo(ArchivoPostulante::class);
    }

    public function puntajes()
    {
        return $this->hasMany(Puntaje::class);
    }
}
