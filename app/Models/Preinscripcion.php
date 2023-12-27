<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preinscripcion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mencion_id',
        'pago_inscripcion_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mencion()
    {
        return $this->belongsTo(Mencion::class);
    }

    public function programaEstudio()
    {
        return $this->belongsTo(ProgramaEstudio::class);
    }

    public function pagoInscripcion()
    {
        return $this->belongsTo(PagoInscripcion::class);
    }
    public function convocatoria()
    {
        return $this->belongsTo(Convocatoria::class);
    }
    public function postulantes()
    {
        return $this->hasMany(Postulante::class);
    }
}
