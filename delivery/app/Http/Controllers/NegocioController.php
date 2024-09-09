<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Negocio;

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
      $id=Auth::id();
      $query="SELECT negocios.*, categorias.nombre as nombrecat
              FROM negocios, categorias
              WHERE negocios.categoria=categorias.id
              AND negocios.user='$id'";
      $negocios = DB::select($query);
      return view('negocios.index',compact('negocios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('negocios.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $file   =   $request->file('archivologo');
      $namelogo      =   time().time().'.'.$file->getClientOriginalExtension();
      $target_path    =   public_path('storage/app/public/uploads/');
      $file->move($target_path, $namelogo);

      $file1   =   $request->file('archivofoto');
      $namefoto      =   time().time().'.'.$file1->getClientOriginalExtension();
      $target_path    =   public_path('storage/app/public/uploads/');
      $file1->move($target_path, $namefoto);


        $negocio = New Negocio;
        $negocio->nombre=$request->nombre;
        $negocio->telefono=$request->telefono;
        $negocio->direccion=$request->direccion;
        $negocio->sector=$request->sector;
        $negocio->latitud=$request->latitud;
        $negocio->longitud=$request->longitud;
        $negocio->tasadecambio=$request->tasadecambio;
        $negocio->lunesa=$request->lunesa;
        $negocio->lunesc=$request->lunesc;
        $negocio->martesa=$request->martesa;
        $negocio->martesc=$request->martesc;
        $negocio->miercolesa=$request->miercolesa;
        $negocio->miercolesc=$request->miercolesc;
        $negocio->juevesa=$request->juevesa;
        $negocio->juevesc=$request->juevesc;
        $negocio->viernesa=$request->viernesa;
        $negocio->viernesc=$request->viernesc;
        $negocio->sabadoa=$request->sabadoa;
        $negocio->sabadoc=$request->sabadoc;
        $negocio->domingoa=$request->domingoa;
        $negocio->domingoc=$request->domingoc;
        $negocio->categoria=$request->categoria;
        $negocio->logo=$namelogo;
        $negocio->foto=$namefoto;
        $negocio->save();
        return redirect()->route('negocios.index')
          ->with('message','Negocio registrado exitosamente.');

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

        return view('negocios.edit',compact('negocio','categorias'));
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
      $negocio->update($request->all());
      return redirect()->route('negocios.index')
          ->with('message','Datos actualizados');
    }

    public function cambiarlogo(Request $request,$id){

      $file   =   $request->file('archivologo');
      $namelogo      =   time().time().'.'.$file->getClientOriginalExtension();
      $target_path    =   public_path('storage/app/public/uploads/');
      $file->move($target_path, $namelogo);

      if(file_exists(public_path('storage/app/public/uploads/'.$request->logo))){
        unlink(public_path('storage/app/public/uploads/'.$request->logo));
      }else{
        dd('File does not exists.');
      }

      $query="UPDATE negocios SET logo='$namelogo' WHERE id='$id'";
      DB::select($query);

        return redirect('negocios');

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

      $query="UPDATE negocios SET foto='$namefoto' WHERE id='$id'";
      DB::select($query);

        return redirect('negocios');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Negocio  $negocio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Negocio $negocio)
    {
        if(file_exists(public_path('storage/app/public/uploads/'.$negocio->logo))){
          unlink(public_path('storage/app/public/uploads/'.$negocio->logo));
        }else{
          //dd('File does not exists.');
        }
        if(file_exists(public_path('storage/app/public/uploads/'.$negocio->foto))){
          unlink(public_path('storage/app/public/uploads/'.$negocio->foto));
        }else{
          //dd('File does not exists.');
        }

        $negocio->delete();
        return redirect()->route('negocios.index')
          ->with('message','Negocio Eliminado');

    }

    public function ubicaciones(){

        return view('negocios.ubicaciones');

    }



}
