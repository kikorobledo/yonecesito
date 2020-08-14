<?php

namespace App;

use App\Tarea;
use App\Perfil;
use Carbon\Carbon;
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

    /* Relacion 1:1 Un Usuario tiene  un perfil */
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }
}
