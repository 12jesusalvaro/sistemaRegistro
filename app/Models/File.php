<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $table = 'archivo_postulantes';
    protected $fillable = ['name', 'postulante_id'];

    public function postulante()
    {
        return $this->belongsTo(Postulante::class, 'postulante_id');
    }

}
