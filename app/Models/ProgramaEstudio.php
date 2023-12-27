<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaEstudio extends Model
{
    use HasFactory;

    // Resto del código del modelo ProgramaEstudio

    public function preinscripciones()
    {
        return $this->hasMany(Preinscripcion::class);
    }
}
