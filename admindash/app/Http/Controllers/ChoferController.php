<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Chofer;
use App\User;
use App\Negocio;

use DB;

use Illuminate\Http\Request;

class ChoferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
        $query="SELECT c.id, c.estatus, c.descripcion, u.id as usuario, u.name, u.telefono, n.nombre
                FROM choferes as c, users as u, negocios as n
                WHERE c.usuario=u.id and c.negocio=n.id and n.user='$id'";
        $choferes=DB::select($query);

        return view('choferes.index',compact('choferes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$choferes=User::where('rol', '=', '3');
        $query="select * from users where rol='3'";
        $choferes=DB::select($query);

        $negocios = Negocio::All();
        return view('choferes.create',compact('choferes','negocios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Chofer::create($request->all());
        return redirect('choferes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function show(Chofer $chofer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function edit(Chofer $chofer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chofer $chofer)
    {
      $query="update choferes SET estatus='$request->estatus' where id='$request->id'";
      DB::select($query);
      //echo $query;
        return redirect()->route('choferes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chofer  $chofer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Chofer $chofer)
    {
      $query="delete from choferes where id='$request->id'";
      DB::select($query);
      //$chofer->delete();
      return redirect()->route('choferes.index')
        ->with('message','Chofer Eliminado');
    }
}
