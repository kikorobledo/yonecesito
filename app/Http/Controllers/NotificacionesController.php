<?php

namespace App\Http\Controllers;

use App\Tarea;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /* Ofertas */
    public function ofertas(){

        $notificaciones_nuevas = auth()->user()->unreadNotifications->where('type','App\Notifications\NuevaOferta')->all();

        $notificaciones_anteriores = auth()->user()->notifications->where('type','App\Notifications\NuevaOferta')->all();

        auth()->user()->unreadNotifications->where('type','App\Notifications\NuevaOferta')->markAsRead();

        return view('notificaciones.ofertas', compact('notificaciones_nuevas', 'notificaciones_anteriores'));
    }

    /* Preguntas */
    public function preguntas(){

        $notificaciones_nuevas = auth()->user()->unreadNotifications->where('type','App\Notifications\NuevaPregunta')->all();

        $notificaciones_anteriores = auth()->user()->notifications->where('type','App\Notifications\NuevaPregunta')->all();

        auth()->user()->unreadNotifications->where('type','type','App\Notifications\NuevaPregunta')->markAsRead();

        return view('notificaciones.preguntas', compact('notificaciones_nuevas', 'notificaciones_anteriores'));
    }

    /* Resputestas */
    public function respuestas(){

        $notificaciones_nuevas_respuestas_pregunta = auth()->user()->unreadNotifications->where('type','App\Notifications\NuevaRespuestaPregunta')->all();
        $notificaciones_nuevas_respuestas_oferta = auth()->user()->unreadNotifications->where('type','App\Notifications\NuevaRespuestaOferta')->all();

        $notificaciones_anteriores_nuevas_respuestas_pregunta = auth()->user()->notifications->where('type','App\Notifications\NuevaRespuestaPregunta')->all();
        $notificaciones_anteriores_nuevas_respuestas_oferta = auth()->user()->notifications->where('type','App\Notifications\NuevaRespuestaOferta')->all();

        auth()->user()->unreadNotifications->where('type','type','App\Notifications\NuevaRespuestaPregunta')->markAsRead();
        auth()->user()->unreadNotifications->where('type','type','App\Notifications\NuevaRespuestaOferta')->markAsRead();

        return view('notificaciones.respuestas', compact('notificaciones_nuevas_respuestas_pregunta', 'notificaciones_nuevas_respuestas_oferta','notificaciones_anteriores_nuevas_respuestas_pregunta','notificaciones_anteriores_nuevas_respuestas_oferta'));
    }

    /* Asignaciones */
    public function asignaciones(){

        $tareas = Tarea::where('user_id', auth()->user()->id)->where('estatus', 'asignada')->get()->sortBy('updated_at');

        $notificaciones_nuevas = auth()->user()->unreadNotifications->where('type','App\Notifications\NuevaAsignacion')->all();

        $notificaciones_anteriores = auth()->user()->notifications->where('type','App\Notifications\NuevaAsignacion')->all();

        $tareas_asignadas = Tarea::where('trabajador', auth()->user()->id)->get()->sortBy('updated_at');

        auth()->user()->unreadNotifications->where('type','type','App\Notifications\NuevaAsignacion')->markAsRead();

        return view('notificaciones.asignaciones', compact('notificaciones_nuevas', 'notificaciones_anteriores','tareas', 'tareas_asignadas'));
    }
}
