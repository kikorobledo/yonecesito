<?php

namespace App\Http\Controllers;

use App\User;
use App\Tarea;
use App\Oferta;
use App\Perfil;
use App\Resena;
use App\Mensaje;
use App\Pregunta;
use Illuminate\Http\Request;
use App\Notifications\NuevaOferta;
use Illuminate\Support\Facades\DB;
use App\Notifications\NuevoMensaje;
use App\Notifications\NuevaPregunta;
use App\Notifications\TareaConcluida;
use App\Notifications\NuevaAsignacion;

class APIController extends Controller
{
    //Metodo para obtener todas las tareas
    public function tareas(){

        $tareas = Tarea::whereNotNull('colonia')->where('estatus', 'activa')->with('usuario.perfil', 'estado')->get();

        return response()->json($tareas);
    }

    //Metodo para obtener todas las tareas
    public function tarea($id){

        $tarea = Tarea::where('id', $id)->with('usuario.perfil', 'estado')->first();

        return response()->json($tarea);
    }

    /* Metodo para obtener las ofertas de una tarea */
    public function ofertas($id){

        $ofertas = Oferta::where('tarea_id', $id)->with('respuestas.autor.perfil', 'autor.perfil')->get();

        return response()->json($ofertas);
    }

    /* Metodo para obtener las ofertas de una tarea */
    public function preguntas($id){

        $preguntas = Pregunta::where('tarea_id', $id)->with('respuestas.autor.perfil', 'autor.perfil')->get();

        return response()->json($preguntas);
    }

    /* Metodo para obtener a un usuario */
    public function usuario($id){

        $usuario = User::where('id', $id)->with('perfil','datosBancarios')->get();

        return response()->json($usuario);
    }

    /* Actualizar foto de perfil */
    public function actualizar_foto(Request $request){

        $imagen = $request->file('imagen');
        $nombreImagen = time() . '.' . $imagen->extension();
        $imagen->move(public_path('storage/perfiles/imagenes'), $nombreImagen);

        $perfil = Perfil::findOrFail($request['perfil_id']);

        $perfil->imagen = $nombreImagen;

        $perfil->save();

        return response()->json($perfil);
    }

    /* Actualizar telefono perfil */
    public function actualizar_telefono(Request $request){

        $perfil = Perfil::findOrFail($request['perfil_id']);

        $perfil->telefono = $request['telefono'];

        $perfil->save();

        return response()->json($perfil);
    }

    /* Actualizar fecha de nacimiento */
    public function actualizar_fecha_de_nacimiento(Request $request){

        $perfil = Perfil::findOrFail($request['perfil_id']);

        $perfil->fecha_de_nacimiento = $request['fecha_de_nacimiento'];

        $perfil->save();

        return response()->json($perfil);

    }

    /* Crear Oferta */
    public function crearOferta(Request $request){

        if($request['presupuesto'])
            $presupuesto = $request['presupuesto'];
        else {
            $presupuesto = 0;
        }

        if($request['imagen']){

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->extension();
            $imagen->move(public_path('storage/ofertas'), $nombreImagen);

            $oferta = new Oferta([
                'contenido' => $request['contenido'],
                'imagen' => $nombreImagen,
                'tarea_id' => $request['tarea_id'],
                'user_id' => $request['usuario_id'],
                'presupuesto' => $presupuesto
            ]);

            $oferta->save();

            $usuario = $oferta->tarea->usuario;

            $usuario->notify(new NuevaOferta($oferta->tarea, $oferta));

            return response()->json($oferta);

        }else{
            $oferta = new Oferta([
                'contenido' => $request['contenido'],
                'tarea_id' => $request['tarea_id'],
                'user_id' => $request['usuario_id'],
                'presupuesto' => $presupuesto
            ]);

            $oferta->save();

            $usuario = $oferta->tarea->usuario;

            $usuario->notify(new NuevaOferta($oferta->tarea, $oferta));

            return response()->json($oferta);
        }

    }

    /* Eliminar Oferta */
    public function eliminarOferta(Oferta $oferta){

        $oferta->delete();

        $notificaciones = DB::table('notifications')->where('data->oferta_id', $oferta->id )->get();

        foreach($notificaciones as $notificacion)
            DB::table('notifications')->where('id', $notificacion->id)->delete();

        return response()->json($oferta);
    }

    /* Crear Pregunta */
    public function crearPregunta(Request $request){

        if($request['imagen']){

            $imagen = $request->file('imagen');
            $nombre_imagen = time() . '.' . $imagen->extension();
            $imagen->move(public_path('storage/preguntas'), $nombre_imagen);

            $pregunta = new Pregunta([
                'contenido' => $request['contenido'],
                'imagen' => $nombre_imagen,
                'tarea_id' => $request['tarea_id'],
                'user_id' => $request['user_id']
            ]);

            $pregunta->save();

            $usuario = $pregunta->tarea->usuario;

            $usuario->notify(new NuevaPregunta($pregunta->tarea, $pregunta));

            return response()->json($pregunta);

        }else{

            $pregunta = new Pregunta([
                'contenido' => $request['contenido'],
                'tarea_id' => $request['tarea_id'],
                'user_id' => $request['user_id']
            ]);

            $pregunta->save();

            $usuario = $pregunta->tarea->usuario;

            $usuario->notify(new NuevaPregunta($pregunta->tarea, $pregunta));

            return response()->json($pregunta);
        }
    }

    /* Eliminar Pregunta */
    public function eliminarPregunta(Pregunta $pregunta){

        $pregunta->delete();

        return response()->json($pregunta);
    }

    /* Filtrar Tareas */
    public function filtrarTareas(Request $request){

        if($request['search'] !== "null")
            $search = true;
        else
            $search = false;

        if($request['tipo'] === "null")
            $tipo = false;
        else
            $tipo = true;

        if($request['estado'] !== "null")
            $estado = true;
        else
            $estado = false;

        if($request['presupuesto'] !== "null")
            $presupuesto = true;
        else
            $presupuesto = false;

        $query = Tarea::query();

        $query->where('estatus', 'activa')->when($tipo, function($query){
            return $query->where('tipo', request()->input('tipo'));
        })
        ->when($estado, function($query){
            return $query->where('estado_id', request()->input('estado'));
        })
        ->when($presupuesto, function($query){
            return $query->where('presupuesto', '>', request()->input('presupuesto'));
        })
        ->when($search, function($query){
            return $query->where('nombre', 'like', '%' . request()->input('search') . '%')
            ->orwhere( 'colonia', 'like', '%' . request()->input('search') . '%')
            ->orwhere('direccion', 'like', '%' . request()->input('search') . '%')
            ->orwhere('descripcion', 'like', '%' . request()->input('search') . '%');
        });

        $tareas_filtradas = $query
        ->with('usuario.perfil', 'estado')
        ->get();

        return response()->json($tareas_filtradas);
    }

    /* Asignar Tarea */
    public function asignar_tarea(Request $request){

        $tarea = Tarea::findOrFail((int)$request['tarea']);
        $trabajador = User::findOrFail((int)$request['trabajador']);

        $tarea->estatus = 'asignada';
        $tarea->trabajador = $trabajador->id;

        $tarea->save();

        $trabajador->notify(new NuevaAsignacion($tarea));

        return response()->json($tarea);
    }

    /* Enviar Mensaje */
    public function enviar_mensaje(Request $request){

        $mensaje = new Mensaje([
            'autor' => $request['autor_id'],
            'contenido' => $request['contenido'],
            'tarea_id' => $request['tarea_id'],
        ]);

        $mensaje->save();

        if($request['autor_id'] == $mensaje->tarea->usuario->id){
            $usuario = $mensaje->tarea->trabajadorAsignado;
        }else{
            $usuario = $mensaje->tarea->usuario;
        }

        $usuario->notify(new NuevoMensaje($mensaje));

        return response()->json($mensaje);

    }

    /* Concluir tarea y guardar reseña */
    public function concluir_tarea(Request $request){

        $tarea = Tarea::where('id', $request['tarea_id'])->first();
        $tarea->estatus = "concluida";
        $tarea->save();

        $resena = new Resena([
            'tipo' => 'trabajador',
            'tarea_id' => $tarea->id,
            'contenido' => $request['contenido'] ,
            'calificado' => $request['calificado'],
            'calificador' => $request['calificador'],
            'rate' => $request['rate'],
        ]);

        $tarea->trabajadorAsignado->notify(new TareaConcluida($tarea));

        $resena->save();

        return response()->json($resena);
    }
}
