<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosGeneral extends Model
{
    use HasFactory;

    protected $table = 'datos_generals';

    protected $fillable = [
        'fecha_nacimiento',
        'sexo',
        'pais_nac_id',
        'nacionalidad_id',
        'distrito_nac_id',
        'direccion_domiciliaria',
        'ubigeo_domicilio',
        'ubigeo_nacimiento',
        'distrito_domic_id',
        'edad',
        'estado_civil_id',
        'discapacidad_id',
    ];

    // Relaciones con otras tablas
    public function paisNacimiento()
    {
        return $this->belongsTo(Pais::class, 'pais_nac_id');
    }

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'nacionalidad_id');
    }

    public function distritoNacimiento()
    {
        return $this->belongsTo(Distrito::class, 'distrito_nac_id');
    }

    public function distritoDomicilio()
    {
        return $this->belongsTo(Distrito::class, 'distrito_domic_id');
    }

    public function estadoCivil()
    {
        return $this->belongsTo(EstadoCivil::class, 'estado_civil_id');
    }

    public function discapacidad()
    {
        return $this->belongsTo(Condicion::class, 'discapacidad_id');
    }
}
