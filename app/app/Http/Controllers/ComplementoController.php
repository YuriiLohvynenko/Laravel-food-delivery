<?php

namespace App\Http\Controllers;

use App\Complemento;
use DB;
use Illuminate\Http\Request;

class ComplementoController extends Controller
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
    public function agregar($idcarrito)
    {
      $query="SELECT menus.nombre, menus.descripcion,
      menus.precio, menus.moneda, menus.foto, menus.negocio, carritos.cantidad, carritos.id
      FROM carritos, menus
      WHERE carritos.menu=menus.id AND carritos.id='$idcarrito'";
      $carrito=DB::select($query);

      $idnegocio=$carrito[0]->negocio;

      $query="select * from adicionales where negocio='$idnegocio'";
      $adicionales=DB::select($query);

      return view('carritos.adicionales',compact('carrito','adicionales'));


    }

    public function agregarvarios()
        {
          //if(isset($_POST['save'])){
            //$user=$_POST['user'];
            $checkbox = $_POST['check'];
            $carrito=$_POST['id'];
            for($i=0;$i<count($checkbox);$i++){
              $del_id = $checkbox[$i];
              if ($del_id) {
                $complemento = New Complemento;
                $complemento->carrito=$carrito;
                $complemento->adicional=$del_id;
                $complemento->save();
              }
            }
          //}
          //return redirect("permisos");
          return redirect("/carrito");
          //return back();
        }

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
     * @param  \App\Complemento  $complemento
     * @return \Illuminate\Http\Response
     */
    public function show(Complemento $complemento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Complemento  $complemento
     * @return \Illuminate\Http\Response
     */
    public function edit(Complemento $complemento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Complemento  $complemento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complemento $complemento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Complemento  $complemento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Complemento $complemento)
    {
      //echo "hola";
      //echo $request->idcomplemento;
      $complemento->delete();
      return back();
    }

    public function eliminar($id){
      echo "hola";
      echo $id;
    }
}
