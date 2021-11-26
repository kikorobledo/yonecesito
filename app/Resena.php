<?php

namespace App;

use App\User;
use App\Perfil;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{

    protected $fillable =['rate', 'contenido', 'calificado', 'calificador','tipo','tarea_id'];

    /* Obtiene el Prefil al que pertenece */
    public function perfil(){
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    /* Obtener usuario calificador */
    public function usuarioCalificador(){
        return $this->belongsTo(User::class, 'calificador');
    }

    /* Obtener usuario calificado */
    public function usuarioCalificado(){
        return $this->belongsTo(User::class, 'calificado');
    }
}
