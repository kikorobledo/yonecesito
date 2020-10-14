<?php

namespace App;

use App\Oferta;
use App\Pregunta;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['nombre','direccion','colonia','estado_id','lat','lng','descripcion','fecha_de_vencimiento','presupuesto','estatus', 'tipo', 'user_id', 'trabajador'];

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
}
