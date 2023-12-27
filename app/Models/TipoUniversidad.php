<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUniversidad extends Model
{
    use HasFactory;
    protected $table = 'tipo_universidads';

    protected $fillable = [
        'nombre',
    ];
}
