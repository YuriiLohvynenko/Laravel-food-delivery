<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\Negocio;
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
      $id=Auth::id();
      $query="select menus.*, negocios.nombre as nombrenegocio from menus, negocios
              where menus.negocio=negocios.id and negocios.user='$id'";
      $menus = DB::select($query);
      return view('menus.index',compact('menus'));
    }

    public function mostrar($id)
    {

      $query="select menus.*, negocios.nombre as nombrenegocio from menus, negocios
              where menus.negocio=negocios.id AND menus.negocio='$id'";
      $menus = DB::select($query);
      return view('menus.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $negocios = Negocio::all();
      return view('menus.create',compact('negocios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file   =   $request->file('archivofoto');
        $namefoto      =   time().time().'.'.$file->getClientOriginalExtension();
        $target_path    =   public_path('storage/app/public/uploads/');
        $file->move($target_path, $namefoto);

          $menu = New Menu;
          $menu->nombre=$request->nombre;
          $menu->negocio=$request->negocio;
          $menu->precio=$request->precio;
          $menu->moneda=$request->moneda;
          $menu->descripcion=$request->descripcion;
          $menu->foto=$namefoto;
          $menu->save();
          return redirect()->route('menus.index')
            ->with('message','Plato registrado exitosamente.');
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

      return view('menus.edit',compact('menu','negocios'));
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
      $menu->update($request->all());
      return redirect()->route('menus.index')
          ->with('message','Datos actualizados');
    }

    public function cambiarfoto(Request $request,$id){

      $file   =   $request->file('archivofoto');
      $namefoto      =   time().time().'.'.$file->getClientOriginalExtension();
      $target_path    =   public_path('storage/app/public/uploads/');
      $file->move($target_path, $namefoto);

      if(file_exists(public_path('storage/app/public/uploads/'.$request->foto))){
        unlink(public_path('storage/app/public/uploads/'.$request->foto));
      }else{
        //dd('File does not exists.');
      }

      $query="UPDATE menus SET foto='$namefoto' WHERE id='$id'";
      DB::select($query);

        return redirect('menus');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
      if(file_exists(public_path('storage/app/public/uploads/'.$menu->foto))){
        unlink(public_path('storage/app/public/uploads/'.$menu->foto));
      }else{
        //dd('File does not exists.');
      }

      $menu->delete();
      return redirect()->route('menus.index')
        ->with('message','Plato Eliminado');
    }
}
