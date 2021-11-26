<?php

namespace App\Http\Controllers;

use App\Resena;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    /* Guardar reseña */
    public function store(Request $request){

        $resena = new Resena([
            'tipo' => 'ofertante',
            'rate' => $request['rate'],
            'tarea_id' => $request['tarea_id'],
            'contenido' => $request['contenido'],
            'calificado' => $request['calificado'],
            'calificador' => $request['calificador']
        ]);

        $resena->save();

        return view('tareas.tareas');
    }
}
