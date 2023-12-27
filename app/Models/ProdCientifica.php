<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdCientifica extends Model
{
    use HasFactory;
    protected $table = 'prod_cientifica';
    protected $fillable = [
        'titulo',
        'nombre',
        'anio',
        'numero',
        'volumen',
        'paginas',
        'hasta_pag',
        'postulante_id',
    ];

    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'postulante_id');
    }
}
