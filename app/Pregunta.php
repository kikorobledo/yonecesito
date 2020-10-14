<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable=['tarea_id','user_id'];

    /* Obtiene la tarea a la que pertenece */
    public function tarea(){
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

    /* Obtiene el autor d e la pregunta */
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }

    /* Obtiene respuestas de la pregunta */
    public function respuestas(){
        return $this->hasMany(RespuestaPregunta::class);
    }
}
