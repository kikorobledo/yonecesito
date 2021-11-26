<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = ['contenido','imagen','tarea_id','user_id','presupuesto'];

    protected $dates = ['created_at'];

    protected $appends = ['createdAtHumanReadable'];

    public function getCreatedAtHumanReadableAttribute(){
        return $this->created_at->diffForHumans();
    }

    /* Obtiene la tarea a la que pertenece */
    public function tarea(){
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

    /* Obtiene el autor de la oferta */
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }

    /* Obtiene respuestas de la oferta */
    public function respuestas(){
        return $this->hasMany(RespuestaOferta::class);
    }
}
