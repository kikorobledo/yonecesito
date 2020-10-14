<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RespuestaOferta extends Model
{
    //
    protected $table = "respuesta_ofertas";

    protected $fillable=['contenido','uuid','oferta_id','user_id','imagen'];

    /* Obtiene la Oferta a la que pertenece */
    public function oferta(){
        return $this->belongsTo(Oferta::class, 'oferta_id');
    }

    /* Obtiene el autor de la respuesta */
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
