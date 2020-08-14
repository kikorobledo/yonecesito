<?php

namespace App;

use App\Oferta;
use App\Pregunta;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['nombre','direccion','colonia','lat','lng','descripcion','fecha_de_vencimiento','uuid','presupuesto','estado'];

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
}
