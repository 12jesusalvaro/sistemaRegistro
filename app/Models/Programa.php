<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'active',
    ];

    public function tipoPrograma()
    {
        return $this->belongsTo(TipoPrograma::class);
    }
}
