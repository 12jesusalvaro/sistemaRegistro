<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EscalaValorativa extends Model
{
    use HasFactory;
    protected $table = 'escala_valorativas';
    protected $fillable = ['nombre'];
}
