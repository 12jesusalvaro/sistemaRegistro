<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrograma extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'nombre'
    ];

    public function porcentajeNota()
    {
        return $this->hasMany(PorcentajeNota::class);
    }

    public function convocatorias()
    {
        return $this->belongsToMany(Convocatoria::class, 'convocatoria_tipo_programa');
    }
}
