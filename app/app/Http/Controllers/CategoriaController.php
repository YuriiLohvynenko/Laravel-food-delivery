<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Categoria;
use App\Carrito;
use DB;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categorias = Categoria::all();

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
        return view('categorias.index',compact('categorias','carritos','num','complementos'));
      }
      else {
        $num=0;
        return view('categorias.index',compact('categorias','num'));
      }
    }



    public function welcome()
    {
        $categorias = Categoria::all();

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
          return view('categorias.welcome',compact('categorias','carritos','num','complementos'));
        }
        else {
          $num=0;
          return view('categorias.welcome',compact('categorias','num'));
        }


        //return view('categorias.welcome',compact('categorias','carritos'));
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
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
