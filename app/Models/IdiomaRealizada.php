<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdiomaRealizada extends Model
{
    use HasFactory;
    protected $table = 'idioma_realizadas';
    protected $fillable = [
        'list_idioma_id',
        'habla_id',
        'lee_id',
        'escribe_id',
        'postulante_id',
    ];

    public function listIdioma()
    {
        return $this->belongsTo(Idioma::class, 'list_idioma_id');
    }

    public function habla()
    {
        return $this->belongsTo(EscalaValorativa::class, 'habla_id');
    }

    public function lee()
    {
        return $this->belongsTo(EscalaValorativa::class, 'lee_id');
    }

    public function escribe()
    {
        return $this->belongsTo(EscalaValorativa::class, 'escribe_id');
    }

    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'postulante_id');
    }
}
