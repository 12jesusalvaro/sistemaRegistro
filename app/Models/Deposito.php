<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model
{
    use HasFactory;
    protected $fillable = [
        'importe',
        'numero',
        'operacion',
        'codigo_usuario',
        'fecha',
    ];
}
