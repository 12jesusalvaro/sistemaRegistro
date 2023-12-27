<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mencion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'active',
        'programa_id',
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class);
    }

    public function evaluador()
    {
        return $this->belongsTo(Evaluador::class);
    }

    public function historiales()
    {
        return $this->hasMany(HistorialMencion::class);
    }

}
