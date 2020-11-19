<?php

namespace App\Http\Controllers;

use App\DatoBancario;
use Illuminate\Http\Request;

class DatoBancarioController extends Controller
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'direccion' => 'required',
            'colonia' => 'required',
            'codigo_postal' => 'required',
            'propietario_tarjeta' => 'required',
            'numero_tarjeta' => 'required',
            'estado_id' => 'required',
            'user_id' => 'required'
        ]);


        $datoBancario = DatoBancario::where('user_id', $data['user_id'])->firstOrFail();

        $datoBancario->direccion = $data['direccion'];
        $datoBancario->colonia = $data['colonia'];
        $datoBancario->codigo_postal = $data['codigo_postal'];
        $datoBancario->propietario_tarjeta = $data['propietario_tarjeta'];
        $datoBancario->numero_tarjeta = $data['numero_tarjeta'];
        $datoBancario->estado_id = $data['estado_id'];

        $datoBancario->save();

        return response()->json($datoBancario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
