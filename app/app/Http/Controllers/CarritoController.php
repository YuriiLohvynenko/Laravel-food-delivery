<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Carrito;
use DB;
use Illuminate\Http\Request;

class CarritoController extends Controller
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

    public function ver()
    {
      $id=Auth::id();
      $query="SELECT menus.nombre, menus.descripcion,
      menus.precio, menus.moneda, menus.foto, menus.negocio, carritos.cantidad, carritos.id
      FROM carritos, menus
      WHERE carritos.menu=menus.id AND carritos.user='$id'";
      //echo $query;
      $carritos=DB::select($query);

      if(count($carritos)){
        $id=$carritos[0]->id;
        $idnegocio=$carritos[0]->negocio;

        //le paso todos complementos y filtro en la vista (paso solo los del negocio que son menos)
        $query="SELECT c.id, c.carrito, a.nombre, a.precio, a.moneda, a.negocio
          FROM complementos as c, adicionales as a
          WHERE c.adicional=a.id AND a.negocio='$idnegocio'";
          $complementos=DB::select($query);

          $query="select tasadecambio from negocios where id='$idnegocio'";
          $datosnegocio=DB::select($query);
          //print_r($negocio);
          //echo $negocio[0]->tasadecambio;

          return view('carritos.carrito',compact('carritos','complementos','datosnegocio'));
        }
        else {
          return redirect('/');
        }
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
        $id=Auth::id();
        //se valida si el carrito esta vacio
        //si esta vacío se agrega sin validar negocio
        $count = Carrito::where('user', '=', $id)->count();

        if ($count) {
          // se hace la validación
            $query="SELECT DISTINCT menus.negocio
                FROM carritos, menus
                WHERE carritos.menu=menus.id
                AND carritos.user='$id'
                AND menus.negocio='$request->negocio'";
                //echo $query;
                $validacion=DB::select($query);
                if (sizeof($validacion)) {
                  Carrito::create($request->all());
                  return back();
                }
                else {
                  return back()->with('message', 'Tu carrito ya contiene artículos de otro negocio');
                }
        }
        else {
          Carrito::create($request->all());
          return back();
        }

/*
        $query="SELECT DISTINCT menus.negocio
            FROM carritos, menus
            WHERE carritos.menu=menus.id
            AND carritos.user='$id'
            AND menus.negocio='$request->negocio'";
            echo $query;
        $validacion=DB::select($query);

        if (sizeof($validacion)) {
          // code...
        }

        //Carrito::create($request->all());
        //return back();
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function show(Carrito $carrito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function edit(Carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrito $carrito)
    {
        $query="delete from complementos where carrito='$carrito->id'";
        DB::select($query);

        $carrito->delete();
        return back();
    }

    public function vaciar(){
      //echo "vaciar";

      $id=Auth::id();
      $query="select id from carritos where user='$id'";

      $carritos=DB::select($query);

      foreach ($carritos as $row) {
        $query="delete from complementos where carrito='$row->id'";
        DB::select($query);
      }

      $query="delete from carritos where user='$id'";
      DB::select($query);

      return redirect('categorias');

    }



}
