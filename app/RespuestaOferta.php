<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaOferta extends Model
{
    //
    protected $table = "respuesta_ofertas";

    protected $fillable=['contenido','uuid','oferta_id','user_id'];

    /* Obtiene la Oferta a la que pertenece */
    public function oferta(){
        return $this->belongsTo(Oferta::class, 'oferta_id');
    }
}
