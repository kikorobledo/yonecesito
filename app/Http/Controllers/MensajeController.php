<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function misMensajes(Request $request){

        $tareas1 = Tarea::where('trabajador', auth()->user()->id)->has('mensajes')->with('mensajes')->get();

        $tareas2 = Tarea::where('user_id', auth()->user()->id)->has('mensajes')->with('mensajes')->get();

        $tareas = $tareas1->merge($tareas2)->sortBy('mensjaes.created_at');

        $mensajes = count($tareas);

        $notificaciones_nuevas = auth()->user()->unreadNotifications->where('type','App\Notifications\NuevoMensaje')->all();

        auth()->user()->unreadNotifications->where('type','App\Notifications\NuevoMensaje')->markAsRead();

        return view('mensajes.mensajes')->with('tareas', $tareas)->with('mensajes', $mensajes)->with('notificaciones', $notificaciones_nuevas);

    }
}
