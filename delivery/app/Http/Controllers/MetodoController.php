<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Metodo;
use App\Negocio;
use DB;
use Illuminate\Http\Request;

class MetodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id=Auth::id();
      $query="select metodos.*, negocios.nombre from metodos, negocios
              where metodos.negocio=negocios.id and negocios.user='$id'";
      $metodos=DB::select($query);
      return view('metodos.index',compact('metodos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $negocios = Negocio::all();
        return view('metodos.create',compact('negocios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Metodo::create($request->all());
      return redirect()->route('metodos.index')
        ->with('message','Método de pago registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function show(Metodo $metodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Metodo $metodo)
    {
        $negocios = Negocio::all();
        return view('metodos.edit',compact('metodo','negocios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Metodo $metodo)
    {
      $metodo->update($request->all());
      return redirect()->route('metodos.index')
          ->with('message','Método de pago actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Metodo  $metodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Metodo $metodo)
    {
      $metodo->delete();
      return redirect()->route('metodos.index')
        ->with('message','Método de pago eliminado');
    }
}
