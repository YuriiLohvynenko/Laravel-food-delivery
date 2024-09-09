<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Menu;
use App\Carrito;
use DB;
use Illuminate\Http\Request;

class MenuController extends Controller
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

    public function mostrar($id)
    {

        $query="select * from negocios where id='$id'";
        $negocio = DB::select($query);

        $query="select * from menus where negocio='$id'";
        $menus = DB::select($query);
        //busco la información de valoracion//
            $query="SELECT COUNT(*) as num FROM pedidos WHERE negocio='$id';";
            $ventas= DB::select($query);

            $query="SELECT sum(rating) as suma, count(id) as num FROM valoraciones
            WHERE usuario='$id' and tipo='0'";
            $valoraciones = DB::select($query);
            if($valoraciones[0]->num){
              $rating= round($valoraciones[0]->suma/$valoraciones[0]->num);
            }
            else{
              $rating=0;
            }
        //fin valoracion


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

                  return view('menus.mostrar',compact('menus','negocio','carritos','num','complementos','ventas','rating'));
                }
                else {
                  $num=0;
                  return view('menus.mostrar',compact('menus','negocio','num','ventas','rating'));
                }

//        return view('menus.mostrar',compact('menus','negocio','carritos'));
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
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }
}
