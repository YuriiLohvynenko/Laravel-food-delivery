<?php

namespace App\Http\Controllers;

use App\Valoracion;
use DB;

use Illuminate\Http\Request;

class ValoracionController extends Controller
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

    public function valorar(Request $request)
    {
        $pedido=$request->pedido;
        $usuario=$request->usuario;
        return view('valoraciones.create',compact('pedido','usuario'));
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

     public function remove_emoji($text){
           return preg_replace('/[[:^print:]]/', "", $text);
     }

    public function store(Request $request)
    {
      //Valoracion::create($request->all());
      $valoracion = New Valoracion;
      $valoracion->pedido=$request->pedido;
      $valoracion->usuario=$request->usuario;
      $valoracion->rating=$request->rating;
      $valoracion->comentario=$this->remove_emoji($request->comentario);
      $valoracion->tipo=$request->tipo;
      $valoracion->save();

      $query="update pedidos set votocliente='1' where id='$request->pedido'";
      DB::select($query);
      return redirect()->route('pedidos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Valoracion  $valoracion
     * @return \Illuminate\Http\Response
     */
    public function show(Valoracion $valoracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Valoracion  $valoracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Valoracion $valoracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Valoracion  $valoracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Valoracion $valoracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Valoracion  $valoracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Valoracion $valoracion)
    {
        //
    }
}
