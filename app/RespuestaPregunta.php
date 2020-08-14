<?php

namespace App;

use App\Pregunta;
use Illuminate\Database\Eloquent\Model;

class RespuestaPregunta extends Model
{
    //
    protected $table = "respuesta_preguntas";

    protected $fillable=['contenido','uuid','pregunta_id','user_id'];

    /* Obtiene la Pregunta a la que pertenece */
    public function oferta(){
        return $this->belongsTo(Pregunta::class, 'pregunta_id');
    }
}
