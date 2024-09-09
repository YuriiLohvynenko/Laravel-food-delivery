<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Tarifa;
use App\Negocio;
use App\Zona;

use DB;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id=Auth::id();
      $query="select tarifas.*, negocios.nombre as nombrenegocio,
              zonas.nombre as nombrezona, zonas.descripcion
              from tarifas, negocios, zonas
              where tarifas.negocio=negocios.id
              AND tarifas.zona=zonas.id AND negocios.user='$id'";
      $tarifas = DB::select($query);
      //echo $query;
      return view('tarifas.index',compact('tarifas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $negocios = Negocio::all();
      $zonas = Zona::all();
      return view('tarifas.create',compact('negocios','zonas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Tarifa::create($request->all());
      return redirect()->route('tarifas.index')
        ->with('message','tarifa registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarifa $tarifa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarifa $tarifa)
    {
        $negocios = Negocio::all();
        $zonas = Zona::all();
        return view('tarifas.edit',compact('tarifa','negocios','zonas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarifa $tarifa)
    {
      $tarifa->update($request->all());
      return redirect()->route('tarifas.index')
          ->with('message','Datos actualizados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarifa $tarifa)
    {
      $tarifa->delete();
      return redirect()->route('tarifas.index')
        ->with('message','Tarifa Eliminada');
    }
}
