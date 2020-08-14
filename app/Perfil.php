<?php

namespace App;

use App\User;
use App\Resena;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = ['imagen', 'titulo', 'acerca_de_mi', 'cv', 'educacion', 'especialidad', 'idiomas', 'trabajo', 'direccion', 'colonia','correo','user_id'];

    //* Relacion 1:n 1 Perfil muchas reseñas */
    public function resena()
    {
        return $this->hasMany(Resena::class);
    }

    /* Obtiene el Usuario al que pertenece */
    public function usuario(){
        return $this->belongsTo(User::class);
    }
}
