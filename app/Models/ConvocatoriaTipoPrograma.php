<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConvocatoriaTipoPrograma extends Model
{
    use HasFactory;
    protected $table = 'convocatoria_tipo_programa';
    public $timestamps = false;

    protected $fillable = [
        'convocatoria_id',
        'tipo_programa_id',
    ];
}
