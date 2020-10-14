<?php

namespace App\Http\Controllers;

use App\User;
use App\RespuestaOferta;
use Illuminate\Http\Request;

class RespuestaOfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'contenido_respuesta_oferta' => 'required',
            'oferta_id' => 'required',
            'user_id' => 'required',
            'imagen-respuesta-oferta' => 'image'
        ]);

        if($request['imagen-respuesta-oferta']){

            $ruta_imagen = $request['imagen-respuesta-oferta']->store('respuestas_oferta','public');

            $respuesta_oferta = new RespuestaOferta([
                'oferta_id' => $data['oferta_id'],
                'user_id' => $data['user_id'],
                'imagen' => $ruta_imagen,
                'contenido' => $data['contenido_respuesta_oferta']
            ]);

            $respuesta_oferta->save();

            $usuario = User::where('id', $data['user_id'])->first();

            $foto = $usuario->perfil->imagen;

            $nombre = $usuario->name;

            return response()->json([
                'respuesta'=> 'Guardado con exito',
                'respuesta_oferta_id' => $respuesta_oferta->id,
                'oferta_id'=> $data['oferta_id'],
                'contenido' => $data['contenido_respuesta_oferta'],
                'imagen' => $ruta_imagen,
                'user' => $nombre,
                'foto' => $foto
            ]);

        }else{

            $usuario = User::where('id', $data['user_id'])->first();

            $foto = $usuario->perfil->imagen;

            $respuesta_oferta = new RespuestaOferta([
                'oferta_id' => $data['oferta_id'],
                'user_id' => $data['user_id'],
                'contenido' => $data['contenido_respuesta_oferta']
            ]);

            $respuesta_oferta->save();

            $nombre = $usuario->name;

            return response()->json([
                'respuesta'=> 'Guardado con exito',
                'respuesta_oferta_id' => $respuesta_oferta->id,
                'oferta_id'=> $data['oferta_id'],
                'contenido' => $data['contenido_respuesta_oferta'],
                'user' => $nombre,
                'foto' => $foto
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RespuestaOferta  $respuestaOferta
     * @return \Illuminate\Http\Response
     */
    public function show(RespuestaOferta $respuestaOferta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RespuestaOferta  $respuestaOferta
     * @return \Illuminate\Http\Response
     */
    public function edit(RespuestaOferta $respuestaOferta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RespuestaOferta  $respuestaOferta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RespuestaOferta $respuestaOferta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RespuestaOferta  $respuestaOferta
     * @return \Illuminate\Http\Response
     */
    public function destroy(RespuestaOferta $respuestaOferta)
    {
        $respuestaOferta->delete();
    }
}
