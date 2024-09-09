<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Adicional;
use App\Negocio;
use DB;

use Illuminate\Http\Request;

class AdicionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id=Auth::id();
      $query="select adicionales.*, negocios.nombre as nombrenegocio from adicionales, negocios
              where adicionales.negocio=negocios.id and negocios.user='$id'";
      $adicionales = DB::select($query);
      return view('adicionales.index',compact('adicionales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $id=Auth::id();
      //$negocios = Negocio::all();
      //$negocios=Negocio::where('user', '=', $id);
      $query="select * from negocios where user='$id'";
      $negocios = DB::select($query);
      return view('adicionales.create',compact('negocios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Adicional::create($request->all());
      $adicional = New Adicional;
      $adicional->nombre=$request->nombre;
      $adicional->negocio=$request->negocio;
      $adicional->precio=$request->precio;
      $adicional->moneda=$request->moneda;
      $adicional->save();

      return redirect()->route('adicionales.index')
        ->with('message','Adicional registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function show(Adicional $adicional)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,Adicional $adicional)
    {
      $negocios = Negocio::all();
      $query="select from adicionales where adicionales.id='$id'";
      $adicional=DB::select($query);
      return view('adicionales.edit',compact('adicional','negocios'));
    }

    public function modificar($id)
    {
      $negocios = Negocio::all();
      $query="select * from adicionales where id='$id'";
      $adicional=DB::select($query);

      return view('adicionales.edit',compact('adicional','negocios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adicional $adicional)
    {

      //$adicional->update($request->all());
      $query="UPDATE adicionales SET nombre='$request->nombre',precio='$request->precio',moneda='$request->moneda' WHERE id='$request->id'";
      DB::select($query);
      return redirect()->route('adicionales.index')
          ->with('message','Datos actualizados');
    }


    public function disponible(Request $request)
    {
      $query="UPDATE adicionales SET disponible='$request->disponible' WHERE id='$request->id'";
      //echo $query;

      DB::select($query);
      return redirect()->route('adicionales.index')
          ->with('message','Datos actualizados');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adicional  $adicional
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Adicional $adicional)
    {
      //$adicional->delete();


      $query="delete from adicionales where adicionales.id='$request->id'";
      DB::select($query);
      return redirect()->route('adicionales.index')
        ->with('message','Adicional Eliminado');

    }
}
