<?php

namespace App;

use App\Pregunta;
use Illuminate\Database\Eloquent\Model;

class RespuestaPregunta extends Model
{
    //
    protected $table = "respuesta_preguntas";

    protected $fillable=['contenido','imagen','pregunta_id','user_id'];

    protected $dates = ['created_at'];

    protected $appends = ['createdAtHumanReadable'];

    public function getCreatedAtHumanReadableAttribute(){
        return $this->created_at->diffForHumans();
    }

    /* Obtiene la Pregunta a la que pertenece */
    public function pregunta(){
        return $this->belongsTo(Pregunta::class, 'pregunta_id');
    }

    /* Obtiene el autor de la pregunta */
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
