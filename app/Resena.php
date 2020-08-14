<?php

namespace App;

use App\Perfil;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{

    protected $fillable =['tipo', 'contenido', 'user_id', 'perfil_id'];

    /* Obtiene el Prefil al que pertenece */
    public function perfil(){
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }
}
