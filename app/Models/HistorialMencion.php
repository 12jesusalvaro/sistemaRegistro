<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMencion extends Model
{
    use HasFactory;
    protected $fillable = ['costo', 'vacantes'];

    public function mencion()
    {
        return $this->belongsTo(Mencion::class);
    }

    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class);
    }
}
