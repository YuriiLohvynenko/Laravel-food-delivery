<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Envio;
use DB;
use Illuminate\Http\Request;

class EnvioController extends Controller
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

    public function reporte(Request $request){
      //$id=Auth::id();
      $id=$request->id;
      $query="select name from users where id='$id'";
      $chofer=DB::select($query);

      $query="select envios.*, pedidos.zona, pedidos.negocio, negocios.nombre, pedidos.costodelivery
              from envios, pedidos, negocios
              where envios.pedido=pedidos.id and
              pedidos.negocio=negocios.id AND
              chofer='$id' order by id DESC";
      $envios=DB::select($query);

      return view('envios.reporte',compact('envios','chofer'));
    }

    public function buscar(Request $request){
      $id=$request->id;
      $query="select name from users where id='$id'";
      $chofer=DB::select($query);


      $query="select envios.*, pedidos.zona, pedidos.costodelivery
      from envios, pedidos
      where envios.pedido=pedidos.id and
      envios.created_at BETWEEN '$request->desde' AND '$request->hasta' and
      chofer='$id' order by id DESC";
      $envios=DB::select($query);
//echo $query;
      return view('envios.reporte',compact('envios','chofer'));
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
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function show(Envio $envio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Envio $envio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Envio $envio)
    {
        //
    }
}
