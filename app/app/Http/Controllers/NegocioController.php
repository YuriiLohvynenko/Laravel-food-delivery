<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Negocio;
use App\Carrito;
use DB;
use Illuminate\Http\Request;

class NegocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $query="select * from negocios order by rand()";
      $negocios = DB::select($query);

      if (Auth::check()){
        $id=Auth::id();
        $query="SELECT menus.nombre, menus.precio, menus.moneda, menus.foto, menus.negocio,
        carritos.cantidad, carritos.id
        FROM carritos, menus
        WHERE carritos.menu=menus.id AND carritos.user='$id'";
        //echo $query;
        $carritos=DB::select($query);
        $num=count($carritos);

        if($num){
          $idnegocio=$carritos[0]->negocio;
          //le paso todos complementos y filtro en la vista (paso solo los del negocio que son menos)
          $query="SELECT c.id, c.carrito, a.nombre, a.precio, a.moneda, a.negocio
            FROM complementos as c, adicionales as a
            WHERE c.adicional=a.id AND a.negocio='$idnegocio'";
            $complementos=DB::select($query);
        }
        else{
          $complementos=0;
        }

        return view('negocios.index',compact('negocios','carritos','num','complementos'));
      }
      else {
        $num=0;
        return view('negocios.index',compact('negocios','num'));
      }

    }

//////////////////////////////////////////
public function buscar(Request $request)
{
  $query="SELECT *
    FROM negocios
    WHERE nombre like '%$request->texto%' or direccion like '%$request->texto%'";

  $negocios = DB::select($query);

  if (Auth::check()){
    $id=Auth::id();
    $query="SELECT menus.nombre, menus.precio, menus.moneda, menus.foto, menus.negocio,
    carritos.cantidad, carritos.id
    FROM carritos, menus
    WHERE carritos.menu=menus.id AND carritos.user='$id'";
    //echo $query;
    $carritos=DB::select($query);
    $num=count($carritos);

    if($num){
      $idnegocio=$carritos[0]->negocio;
      //le paso todos complementos y filtro en la vista (paso solo los del negocio que son menos)
      $query="SELECT c.id, c.carrito, a.nombre, a.precio, a.moneda, a.negocio
        FROM complementos as c, adicionales as a
        WHERE c.adicional=a.id AND a.negocio='$idnegocio'";
        $complementos=DB::select($query);
    }
    else{
      $complementos=0;
    }

    return view('negocios.index',compact('negocios','carritos','num','complementos'));
  }
  else {
    $num=0;
    return view('negocios.index',compact('negocios','num'));
  }

}
////////////////////////////////////////////




    public function mostrar($id)
    {
        $query="select * from negocios where categoria='$id' order by rand()";
        $negocios = DB::select($query);

        if (Auth::check()){
          $id=Auth::id();
          $query="SELECT menus.nombre, menus.precio, menus.moneda, menus.foto, menus.negocio,
          carritos.cantidad, carritos.id
          FROM carritos, menus
          WHERE carritos.menu=menus.id AND carritos.user='$id'";
          //echo $query;
          $carritos=DB::select($query);
          $num=count($carritos);

          if($num){
            $idnegocio=$carritos[0]->negocio;
            //le paso todos complementos y filtro en la vista (paso solo los del negocio que son menos)
            $query="SELECT c.id, c.carrito, a.nombre, a.precio, a.moneda, a.negocio
              FROM complementos as c, adicionales as a
              WHERE c.adicional=a.id AND a.negocio='$idnegocio'";
              $complementos=DB::select($query);
          }
          else{
            $complementos=0;
          }

          return view('negocios.negocioscategoria',compact('negocios','carritos','num','complementos'));
        }
        else {
          $num=0;
          return view('negocios.negocioscategoria',compact('negocios','num'));
        }

        //return view('negocios.negocioscategoria',compact('negocios','carritos'));
    }

    public function detalle($id)
    {

        $query="select * from negocios where id='$id'";
        $negocio = DB::select($query);

        if (Auth::check()){
          $id=Auth::id();
          $query="SELECT menus.nombre, menus.precio, menus.moneda, menus.foto, menus.negocio,
          carritos.cantidad, carritos.id
          FROM carritos, menus
          WHERE carritos.menu=menus.id AND carritos.user='$id'";
          //echo $query;
          $carritos=DB::select($query);
          $num=count($carritos);

          if($num){
            $idnegocio=$carritos[0]->negocio;
            //le paso todos complementos y filtro en la vista (paso solo los del negocio que son menos)
            $query="SELECT c.id, c.carrito, a.nombre, a.precio, a.moneda, a.negocio
              FROM complementos as c, adicionales as a
              WHERE c.adicional=a.id AND a.negocio='$idnegocio'";
              $complementos=DB::select($query);
          }
          else{
            $complementos=0;
          }

          return view('negocios.detalle',compact('negocio','carritos','num','complementos'));
        }
        else {
          $num=0;
          return view('negocios.detalle',compact('negocio','num'));
        }

        //return view('negocios.detalle',compact('negocio','carritos'));
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
     * @param  \App\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function show(Negocio $negocio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function edit(Negocio $negocio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Negocio $negocio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Negocio $negocio)
    {
        //
    }
}
