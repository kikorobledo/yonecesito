<?php

namespace App\Http\Controllers;

use App\Tarea;
use App\Estado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TareaController extends Controller
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
            'nombreTarea' => 'required|min:10',
            'descripcionTarea' => 'required',
            'ubicacion-tarea' => 'required',
            'presupuestoTarea' => 'required',
            'fecha_de_vencimientoTarea' => 'required',
            'tipo' => 'required',
            'ubicacion-tarea' => 'required',
            'user_id' => 'required'
        ]);

        $estado = Estado::where('id', $data['ubicacion-tarea'])->first();

        $tarea = new Tarea([
            'nombre' => $data['nombreTarea'],
            'descripcion' => $data['descripcionTarea'],
            'fecha_de_vencimiento' => $data['fecha_de_vencimientoTarea'],
            'estatus' => 'activa',
            'tipo' => implode(',',$data['tipo']),
            'estado_id' => $data['ubicacion-tarea'],
            'lat' => $estado->lat,
            'lng' => $estado->lng,
            'user_id' => $data['user_id'],
            'presupuesto' => $data['presupuestoTarea']
        ]);

        $tarea->save();

        return redirect()->route('tarea.mistareas', ['tarea_id' => $tarea->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        return view('tareas.tareas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        return view('tareas.edit')->with('tarea', $tarea);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        if($request->has('direccion')){
            $data = $request->validate(['direccion' => 'required']);
            $tarea->direccion = $data['direccion'];
        }

        if($request->has('colonia')){
            $data = $request->validate(['colonia' => 'required']);
            $tarea->colonia = $data['colonia'];
        }

        if($request->has('lat')){
            $data = $request->validate(['lat' => 'required']);
            $tarea->lat = $data['lat'];
        }

        if($request->has('lng')){
            $data = $request->validate(['lng' => 'required']);
            $tarea->lng = $data['lng'];
        }

        if($request->has('fecha_de_vencimiento')){
            $data = $request->validate(['fecha_de_vencimiento' => 'required']);
            $tarea->fecha_de_vencimiento = $data['fecha_de_vencimiento'];
        }

        if($request->has('presupuesto')){
            $data = $request->validate(['presupuesto' => 'required']);
            $tarea->presupuesto = $data['presupuesto'];
        }

        if($request->has('descripcion')){
            $data = $request->validate(['descripcion' => 'required']);
            $tarea->descripcion = $data['descripcion'];
        }

        if($request->has('ubicacion-tarea')){
            $data = $request->validate(['ubicacion-tarea' => 'required']);
            $tarea->estado_id = $data['ubicacion-tarea'];
        }

        $tarea->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
    }

    /* Mis tareas */
    public function mistareas(Request $request){

        $tareas = Tarea::where('user_id', auth()->user()->id)->with('ofertas','preguntas')->get();

        return view('tareas.mistareas')->with('tareas', $tareas);
    }

    /* Todas las tareas */
    public function tareas(){

        $tareas = Tarea::whereNotNull('colonia')->get();

        return view('tareas.tareas')->with('tareas', $tareas);

    }
}
