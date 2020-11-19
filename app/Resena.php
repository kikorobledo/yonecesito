<?php

namespace App;

use App\Perfil;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{

    protected $fillable =['tipo', 'contenido', 'autor', 'receptor'];

    /* Obtiene el Prefil al que pertenece */
    public function perfil(){
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }
}
