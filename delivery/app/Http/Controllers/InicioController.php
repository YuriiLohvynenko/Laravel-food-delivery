<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use DB;

class InicioController extends Controller
{
    public function index(){

      $id=Auth::id();

      $query="select count(id) as num
              from envios
              where YEAR(created_at)=YEAR(NOW()) and
              chofer='$id'";
              $envios = DB::select($query);

      $query="select count(id) as num
              from envios
              where YEAR(created_at)=YEAR(NOW()) and
              MONTH(created_at)=MONTH(NOW()) and
              chofer='$id'";
              $enviosmes = DB::select($query);

      $query="select count(id) as num
              from envios
              where YEAR(created_at)=YEAR(NOW()) and
              DAY(created_at)=DAY(NOW()) and
              chofer='$id'";
              $enviosdia = DB::select($query);

$query="SELECT count(e.id) AS total,
          MONTHNAME(e.created_at) AS mes
          FROM envios e
          where YEAR(e.created_at)=YEAR(NOW()) and
          e.chofer='$id'
          GROUP BY mes;";
          $meses = DB::select($query);

          $query="SELECT count(e.id) AS total,
                  DAY(e.created_at) AS dia
                  FROM envios e
                  where YEAR(e.created_at)=YEAR(NOW())
                  and MONTH(e.created_at)=MONTH(NOW()) AND
                  e.chofer='$id'
                  GROUP BY dia;";
                  $dias = DB::select($query);

              return view('inicio',compact('envios','enviosmes','enviosdia','meses','dias'));

              return view('inicio');
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
