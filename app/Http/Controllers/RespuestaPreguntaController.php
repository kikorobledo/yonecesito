<?php

namespace App\Http\Controllers;

use App\User;
use App\RespuestaPregunta;
use Illuminate\Http\Request;

class RespuestaPreguntaController extends Controller
{
    public function store(Request $request)
    {
        

        $data = $request->validate([
            'contenido_respuesta_pregunta' => 'required',
            'pregunta_id' => 'required',
            'user_id' => 'required',
            'imagen-respuesta-pregunta' => 'image'
        ]);

        if($request['imagen-respuesta-pregunta']){

            $ruta_imagen = $request['imagen-respuesta-pregunta']->store('respuestas_pregunta','public');

            $respuesta_pregunta = new RespuestaPregunta([
                'pregunta_id' => $data['pregunta_id'],
                'user_id' => $data['user_id'],
                'imagen' => $ruta_imagen,
                'contenido' => $data['contenido_respuesta_pregunta']
            ]);

            $respuesta_pregunta->save();

            $usuario = User::where('id', $data['user_id'])->first();

            $foto = $usuario->perfil->imagen;

            $nombre = $usuario->name;

            return response()->json([
                'respuesta'=> 'Guardado con exito',
                'respuesta_pregunta_id' => $respuesta_pregunta->id,
                'pregunta_id'=> $data['pregunta_id'],
                'contenido' => $data['contenido_respuesta_pregunta'],
                'imagen' => $ruta_imagen,
                'user' => $nombre,
                'foto' => $foto
            ]);

        }else{

            $usuario = User::where('id', $data['user_id'])->first();

            $foto = $usuario->perfil->imagen;

            $respuesta_pregunta = new RespuestaPregunta([
                'pregunta_id' => $data['pregunta_id'],
                'user_id' => $data['user_id'],
                'contenido' => $data['contenido_respuesta_pregunta']
            ]);

            $respuesta_pregunta->save();

            $nombre = $usuario->name;

            return response()->json([
                'respuesta'=> 'Guardado con exito',
                'respuesta_pregunta_id' => $respuesta_pregunta->id,
                'pregunta_id'=> $data['pregunta_id'],
                'contenido' => $data['contenido_respuesta_pregunta'],
                'user' => $nombre,
                'foto' => $foto
            ]);

        }

    }

    public function destroy(RespuestaPregunta $respuestaPregunta)
    {
        $respuestaPregunta->delete();
    }
}
