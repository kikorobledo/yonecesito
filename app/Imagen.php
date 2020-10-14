<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    /* Obtiene la tarea al que pertenece */
    public function tarea(){
        return $this->belongsTo(Tarea::class, 'id_tarea');
    }
}
