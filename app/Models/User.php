<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombres',
        'cant_apellidos',
        'primer_apellido',
        'segundo_apellido',
        'celular',
        'tipo_documento_id',
        'numero_documento',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function postulantes()
    {
        return $this->hasManyThrough(
            Postulante::class, // Modelo de destino (Postulante)
            Preinscripcion::class, // Modelo intermedio (Preinscripcion)
            'user_id', // Nombre de la clave foránea en la tabla Preinscripcion
            'preinscripcion_id', // Nombre de la clave foránea en la tabla Postulante
            'id', // Nombre de la clave local en la tabla User
            'id' // Nombre de la clave local en la tabla Preinscripcion
        );
    }

    public function preinscripcion()
    {
        return $this->hasOne(Preinscripcion::class);
    }

    public function secretaria()
    {
        return $this->hasOne(Secretaria::class);
    }

    public function evaluador(): HasOne
    {
        return $this->hasOne(Evaluador::class);
    }

    public function contador(): HasOne
    {
        return $this->hasOne(Contador::class);
    }

    // Define la relación puntajes a través de la relación postulantes
    public function puntajes()
    {
        // Suponiendo que la relación postulantes tiene una relación puntajes
        return $this->hasManyThrough(Puntaje::class, Postulante::class);
    }
    /*public function roles()
    {
        return $this->belongsToMany(Role::class);
    }*/
}
