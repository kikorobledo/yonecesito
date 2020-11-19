<?php

namespace App\Http\Controllers;

use App\User;
use App\Tarea;
use App\Oferta;
use App\Perfil;
use App\Pregunta;
use App\DatoBancario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    //Metodo para obtener todas las tareas
    public function tareas(){

        $tareas = Tarea::whereNotNull('colonia')->where('estatus', 'activa')->with('usuario.perfil', 'estado')->get();

        return response()->json($tareas);
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

        if($request['imagen']){

            $imagen = $request->file('imagen');
            $nombreImagen = time() . '.' . $imagen->extension();
            $imagen->move(public_path('storage/ofertas'), $nombreImagen);

            $oferta = new Oferta([
                'contenido' => $request['contenido'],
                'imagen' => $nombreImagen,
                'tarea_id' => $request['tarea_id'],
                'user_id' => $request['usuario_id']
            ]);

            $oferta->save();

            return response()->json($oferta);

        }else{
            $oferta = new Oferta([
                'contenido' => $request['contenido'],
                'tarea_id' => $request['tarea_id'],
                'user_id' => $request['usuario_id']
            ]);

            $oferta->save();

            return response()->json($oferta);
        }

    }

    /* Eliminar Oferta */
    public function eliminarOferta(Oferta $oferta){

        $oferta->delete();

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

            return response()->json($pregunta);

        }else{

            $pregunta = new Pregunta([
                'contenido' => $request['contenido'],
                'tarea_id' => $request['tarea_id'],
                'user_id' => $request['user_id']
            ]);

            $pregunta->save();

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

        $query->when($tipo, function($query){
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
        ->where('estatus', 'activa')
        ->with('usuario.perfil', 'estado')
        ->get();

        return response()->json($tareas_filtradas);
    }
}
