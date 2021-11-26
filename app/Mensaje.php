<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    protected $fillable =  ['contenido','autor', 'tarea_id'];

    protected $dates = ['created_at'];

    protected $appends = ['createdAtHumanReadable'];

    public function getCreatedAtHumanReadableAttribute(){
        return $this->created_at->diffForHumans();
    }

    /* Obtiene el hilo al que pertenece */
    public function tarea(){
        return $this->belongsTo(Tarea::class, 'tarea_id');
    }

    /* Obtiene el autor al que pertenece */
    public function usuario(){
        return $this->belongsTo(User::class, 'autor');
    }
}
