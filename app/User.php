<?php

namespace App;

use App\Tarea;
use App\Perfil;
use App\Rating;
use App\Resena;
use App\Mensaje;
use Carbon\Carbon;
use App\DatoBancario;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $appends = ['Ratingtrabajador'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Relacion 1:n Un Usuario tiene muchas tareas */
    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    /* Relacion 1:1 Un Usuario tiene un perfil */
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    /* Relacion 1:1 Un Usuario tiene un datoBancario */
    public function datosBancarios()
    {
        return $this->hasOne(DatoBancario::class);
    }

    /* Relacion 1:n Un Usuario tiene muchos mensajes */
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class,'autor');
    }

    /* Relacion 1:n Un Usuario tiene muchos ratings hechos */
    public function ratings_hechos()
    {
        return $this->hasMany(Resena::class,'calificador');
    }

    /* Relacion 1:n Un Usuario tiene muchos ratings recividos */
    public function ratings_recividos()
    {
        return $this->hasMany(Resena::class,'calificado');
    }

    /* Obtener el rating como trabajdor */
    public function getRatingtrabajadorAttribute(){

        $resenas = Resena::where('calificador', $this->id)->where('tipo', 'trabajador')->get();

        $rating = $resenas->avg('rate');

        return round($rating,1);
    }
}
