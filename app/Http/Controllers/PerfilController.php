<?php

namespace App\Http\Controllers;

use App\User;
use App\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PerfilController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        return view('perfiles.show')->with('perfil', $perfil);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        return view('perfiles.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        if($request->has('imagen')){
            $data = $request->validate(['imagen' => 'required']);
            $perfil->imagen = $data['imagen'];
        }

        if($request->has('nombre')){
            $data = $request->validate(['nombre' => 'required']);
            $user = $perfil->usuario;
            $user->name = $data['nombre'];
            $user->save();
        }

        if($request->has('direccion')){
            $data = $request->validate(['direccion' => 'required']);
            $perfil->direccion = $data['direccion'];
        }

        if($request->has('colonia')){
            $data = $request->validate(['colonia' => 'required']);
            $perfil->colonia = $data['colonia'];
        }

        if($request->has('telefono')){
            $data = $request->validate(['telefono' => 'required|numeric']);
            $perfil->telefono = $data['telefono'];
        }

        if($request->has('titulo')){
            $data = $request->validate(['titulo' => 'required|min:6']);
            $perfil->titulo = $data['titulo'];
        }

        if($request->has('descripcion')){
            $data = $request->validate(['descripcion' => 'required']);
            $perfil->acerca_de_mi = $data['descripcion'];
        }

        if($request->has('cv')){
            $data = $request->validate(['cv' => 'required']);
            $perfil->cv = $data['cv'];
        }

        if($request->has('educacion')){
            $data = $request->validate(['educacion' => '']);
            $perfil->educacion = $data['educacion'];
        }

        if($request->has('especialidad')){
            $data = $request->validate(['especialidad' => '']);
            $perfil->especialidad = $data['especialidad'];
        }

        if($request->has('idiomas')){
            $data = $request->validate(['idiomas' => '']);
            $perfil->idiomas = $data['idiomas'];
        }

        if($request->has('trabajo')){
            $data = $request->validate(['trabajo' => '']);
            $perfil->trabajo = $data['trabajo'];
        }

        $perfil->save();

        return view('perfiles.edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }

    /* Subir imagen */
    public function imagen(Request $request){

        $imagen = $request->file('file');
        $nombreImagen = time() . '.' . $imagen->extension();
        $imagen->move(public_path('storage/perfiles/imagenes'), $nombreImagen);

        return response()->json(["correcto" => $nombreImagen]);
    }

    /* Borrar imagen */
    public function borrarimagen(Request $request){

        if($request->ajax()){
            $imagen = $request->get('imagen');

            if(File::exists('storage/perfiles/imagenes/' . $imagen)){
                File::delete('storage/perfiles/imagenes/' . $imagen);
            }

            return response('Imagen eliminada', 200);
        }
    }

    /* Subir CV */
    public function cv(Request $request){

        $cv = $request->file('file');
        $nombreCV = time() . '.' . $cv->extension();
        $cv->move(public_path('storage/perfiles/cv'), $nombreCV);

        return response()->json(["correcto" => $nombreCV]);
    }

    /* Borrar imagen */
    public function borrarcv(Request $request){

        if($request->ajax()){
            $cv = $request->get('cv');

            if(File::exists('storage/perfiles/cv/' . $cv)){
                File::delete('storage/perfiles/cv/' . $cv);
            }

            return response('CV eliminado', 200);
        }
    }
}
