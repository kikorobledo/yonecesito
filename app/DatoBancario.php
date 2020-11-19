<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DatoBancario extends Model
{
    /* Obtiene el Usuario al que pertenece */
    public function usuario(){
        return $this->belongsTo(User::class,'user_id');
    }
}
