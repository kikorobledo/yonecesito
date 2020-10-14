<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){

        /* Leer la imagen */
        $ruta_imagen = $request->file('file')->store('tareas','public');

        /* Resize ala imagen */
        $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800,450);

        $imagen->save();

        /* Almacenar con modelo */
        $imagen_db = new Imagen;
        $imagen_db->id_tarea = $request['id_tarea'];
        $imagen_db->ruta_imagen = $ruta_imagen;

        $imagen_db->save();

        /* Respuesta */
        $respuesta = [
            'archivo' => $ruta_imagen,

        ];

        return response()->json($respuesta);

    }

    public function destroy(Request $request){

        $imagen = $request->get('imagen');

        if(File::exists('storage/' . $imagen)){
            /* Elimina del servidor */
            File::delete('storage/' . $imagen);

            /* Elimina de la BD */
            Imagen::where('ruta_imagen', '=', $imagen)->delete();

            $respuesta = [
                'mensaje' => 'Imagen Eliminada',
                'imagen' => $imagen
            ];
        }

        return response()->json($respuesta);

    }
}
