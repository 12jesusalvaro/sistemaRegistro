<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpProfesional extends Model
{
    use HasFactory;
    protected $table = 'exp_profesionals';

    protected $fillable = [
        'inst_procedencia',
        'carg_actual',
        'fecha_inicio',
        'otros',
        'codigo_otro_inscripcion',
        'cod_orcid',
    ];
}
