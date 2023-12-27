<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PorcentajeNota extends Model
{
    use HasFactory;
    protected $fillable = [
        'nota_1',
        'nota_2',
        'nota_3',
        'nota_4',
        'nota_5',
        'nota_6',
        'nota_7',
    ];
    public function puntaje()
    {
        return $this->hasMany(Puntaje::class);
    }

    public function tipoPrograma()
    {
        return $this->belongsTo(TipoPrograma::class);
    }

}
