<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;

class InicioController extends Controller
{
    public function index(){
      $id=Auth::id();

      $query="SELECT id, estatus from negocios where user='$id'";
      $negocio=DB::select($query);
      
      $id=$negocio[0]->id;

      $query="select count(id) as num
              from pedidos
              where YEAR(created_at)=YEAR(NOW()) and
              negocio='$id'";
              $pedidos = DB::select($query);

      $query="select sum(total) as num
              from pedidos
              where YEAR(created_at)=YEAR(NOW()) and
              negocio='$id'";
              $total = DB::select($query);

              $query="select user from pedidos
              where negocio= '$id' group by user";
              $clientes = DB::select($query);

      $query="SELECT SUM(p.total) AS total,
              MONTHNAME(p.created_at) AS mes
              FROM pedidos p
              where YEAR(p.created_at)=YEAR(NOW()) and
              p.negocio='$id'
              GROUP BY mes;";
              $meses = DB::select($query);

      $query="SELECT SUM(p.total) AS total,
              DAY(p.created_at) AS dia
              FROM pedidos p
              where YEAR(p.created_at)=YEAR(NOW())
              and MONTH(p.created_at)=MONTH(NOW()) AND
              p.negocio='$id'
              GROUP BY dia;";
              $dias = DB::select($query);

              $query="SELECT SUM(p.total) AS total,
                      DAY(p.created_at) AS dia
                      FROM pedidos p
                      where YEAR(p.created_at)=YEAR(NOW())
                      and MONTH(p.created_at)=MONTH(NOW())-1 AND
                      p.negocio='$id'
                      GROUP BY dia;";
                      $diasanterior = DB::select($query);

      return view('inicio',compact('pedidos','total','clientes','meses','dias','diasanterior','negocio'));
    }

    public function activar(Request $request){
      $id=Auth::id();
      //se actualiza el token
        $query="UPDATE users SET token = '$request->token' WHERE id = '$id'";
        DB::select($query);
      //fin token

      return redirect('/');

    }



}
