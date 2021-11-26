<?php

namespace App;

use App\Oferta;
use App\Perfil;
use App\Pregunta;
use App\Categoria;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['nombre','direccion','colonia','estado_id','lat','lng','descripcion','fecha_de_vencimiento','presupuesto','estatus', 'tipo', 'user_id', 'trabajador'];

    protected $dates = ['created_at'];

    protected $appends = ['createdAtHumanReadable'];

    public function getCreatedAtHumanReadableAttribute(){
        return $this->created_at->diffForHumans();
    }

    /* Relacion 1:n 1 Tarea muchas preguntas */
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    /* Relacion 1:n 1 Tarea muchas ofertas */
    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }

    /* Obtiene el usuario al que pertenece */
    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    /* Obtiene el usuario al que pertenece */
    public function imagenes(){
        return $this->hasMany(Imagen::class, 'id_tarea');
    }

    /* Obtiene el estado al que pertenece */
    public function estado(){
        return $this->belongsTo(Estado::class);
    }

    /* Obtiene el estado al que pertenece */
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    /* Obtiene el perfil del autor */
    public function perfil(){
        return $this->hasOneThrough(Perfil::class, Tarea::class, 'user_id', 'user_id');
    }

    /* Obtiene el trabajador al que se le asigno la tarea */
    public function trabajadorAsignado(){
        return $this->belongsTo(User::class, 'trabajador');
    }

    /* Obtiene los mensajes de la tarea */
    public function mensajes(){
        return $this->hasMany(Mensaje::class);
    }
}
