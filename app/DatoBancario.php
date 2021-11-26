<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DatoBancario extends Model
{

    protected $fillable =  ['direccion','colonia','codigo_postal','estado_id','propietario_tarjeta','numero_tarjeta','user_id'];


    /* Obtiene el Usuario al que pertenece */
    public function usuario(){
        return $this->belongsTo(User::class,'user_id');
    }
}
