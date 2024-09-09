<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Negocio;
use App\Pedido;
use App\Pedidodetalle;
use App\Pedidocomplemento;
use App\Envio;


use DB;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=Auth::id();
        /*
        $query="select pedidos.*, negocios.nombre, negocios.logo from pedidos, negocios
        where pedidos.negocio=negocios.id AND negocios.user='$id'
        and (pedidos.estatus<>'DESPACHADO' AND pedidos.estatus<>'CANCELADO') order by created_at DESC";
        */
        $query="select negocios.nombre, negocios.logo, pedidos.id, pedidos.estatus,
         pedidos.created_at, pedidos.total, pedidos.moneda
          from negocios, pedidos
          where pedidos.negocio=negocios.id
          and pedidos.estatus='APROBADO'
          and negocios.id in (select negocio from choferes where choferes.usuario='$id')
          order by pedidos.id DESC";
        $pedidos=DB::select($query);

        //echo $query;
        return view('pedidos.index',compact('pedidos'));
    }

    public function getavailorder()
    {
      $id=Auth::id();     
      $query="select negocios.nombre, negocios.logo, pedidos.id, pedidos.estatus,
       pedidos.created_at, pedidos.total, pedidos.moneda
        from negocios, pedidos
        where pedidos.negocio=negocios.id
        and pedidos.estatus='APROBADO'
        and negocios.id in (select negocio from choferes where choferes.usuario='$id')
        order by pedidos.id DESC";
      $pedidos=DB::select($query);

     return response()->json($pedidos);
    }

    public function historico()
    {
        $id=Auth::id();
        $query="select DISTINCT negocios.nombre, negocios.logo, pedidos.id, pedidos.estatus,
         pedidos.created_at, pedidos.total, pedidos.moneda
          from envios, negocios, pedidos
          where envios.pedido=pedidos.id and pedidos.negocio=negocios.id
          and envios.chofer='$id'
          order by pedidos.id DESC";
        $pedidos=DB::select($query);
        
        return view('pedidos.historico',compact('pedidos'));
    }
    
    public function gethistoryorder()
    {
        $id=Auth::id();
        $query="select DISTINCT negocios.nombre, negocios.logo, pedidos.id, pedidos.estatus,
         pedidos.created_at, pedidos.total, pedidos.moneda
          from envios, negocios, pedidos
          where envios.pedido=pedidos.id and pedidos.negocio=negocios.id
          and envios.chofer='$id'
          order by pedidos.id DESC";
        $pedidos=DB::select($query);
        return response()->json($pedidos);
       
    }
    public function getdeliveryorders()
    {
        $id=Auth::id();
        $query="select pedidos.*
          from envios, pedidos
          where envios.pedido=pedidos.id and envios.chofer='$id' order by pedidos.id DESC";
        $pedidos=DB::select($query);
        return response()->json($pedidos);        
    }
    public function setdeliverylocation(Request $request)
    {
      $id=Auth::id();
      $query="select DISTINCT negocios.nombre, negocios.logo, pedidos.*
      from envios, negocios, pedidos
      where envios.pedido=pedidos.id and pedidos.negocio=negocios.id
      and envios.chofer='$id' and pedidos.estatus='ASIGNADO'
      order by pedidos.id DESC";
        $pedidos=DB::select($query);
        $deliverorders = Envio::where('chofer',$id)->get();
        foreach($deliverorders as $item)
        {
          $item->cur_lat = $request->lat;
          $item->cur_lng = $request->lng;
          $item->save();
        }
      return response()->json($pedidos);
    }


    public function entregas()
    {      
      

        return view('pedidos.entregas');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $id=Auth::id();
      $query="SELECT menus.nombre, menus.descripcion,
      menus.precio, menus.moneda, menus.foto, menus.negocio, carritos.cantidad, carritos.id
      FROM carritos, menus
      WHERE carritos.menu=menus.id AND carritos.user='$id'";
      $carritos=DB::select($query);

      if(count($carritos)){
        $id=$carritos[0]->id;
        $idnegocio=$carritos[0]->negocio;

        //las zonas y los precios puestos por el negocio
        $query="SELECT tarifas.precio, tarifas.moneda, zonas.nombre, zonas.descripcion
        FROM tarifas, zonas WHERE tarifas.zona=zonas.id
        AND tarifas.negocio='$idnegocio'";
        $zonas=DB::select($query);

        //los metodos de pago del negocio
        $query="SELECT * FROM metodos WHERE negocio='$idnegocio'";
        $metodos=DB::select($query);

        //le paso todos complementos y filtro en la vista (paso solo los del negocio que son menos)
        $query="SELECT c.id, c.carrito, a.nombre, a.precio, a.moneda, a.negocio
          FROM complementos as c, adicionales as a
          WHERE c.adicional=a.id AND a.negocio='$idnegocio'";
          $complementos=DB::select($query);

          $query="select tasadecambio from negocios where id='$idnegocio'";
          $datosnegocio=DB::select($query);
          //print_r($negocio);
          //echo $negocio[0]->tasadecambio;

          return view('pedidos.create',compact('carritos','complementos','datosnegocio','zonas','metodos'));
        }
        else {
          return redirect('/');
        }

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
/*
        $id=Auth::id();
        echo $id;
        echo $request->negocio."<hr>";
        echo $request->metodo."<hr>";
        echo $request->nombrezona."<hr>";
        echo $request->urbanizacion."<hr>";
        echo $request->calle."<hr>";
        echo $request->casa."<hr>";
        echo $request->referencia."<hr>";
        echo $request->lat."<hr>";
        echo $request->lon."<hr>";
        echo $request->subtotal."<hr>";
        echo $request->costodelivery."<hr>";
        echo $request->total."<hr>";
        echo $request->tasadecambio."<hr>";
        echo $request->totalbs."<hr>";
        echo $request->archivofoto."<hr>";
        echo $request->instrucciones."<hr>";
*/

/*
        $file1   =   $request->file('archivofoto');
        $namefoto      =   time().time().'.'.$file1->getClientOriginalExtension();
        $target_path    =   public_path('storage/app/public/uploads/');
        $file1->move($target_path, $namefoto);
*/
          //se crea el pedido
          $pedido = New Pedido;
          $pedido->user=$id;
          $pedido->negocio=$request->negocio;
          $pedido->metodo=$request->metodo;
          $pedido->zona=$request->nombrezona;
          $pedido->urbanizacion=$request->urbanizacion;
          $pedido->calle=$request->calle;
          $pedido->casa=$request->casa;
          $pedido->referencia=$request->referencia;
          $pedido->latitud=$request->lat;
          $pedido->longitud=$request->lon;
          $pedido->subtotal=$request->subtotal;
          $pedido->moneda=$request->moneda;
          $pedido->costodelivery=$request->costodelivery;
          $pedido->total=$request->total;
          $pedido->tasadecambio=$request->tasadecambio;
  //        $pedido->comprobante=$namefoto;
          $pedido->instrucciones=$request->instrucciones;
          $pedido->save();

          //se crean los detalles que estan en el carrito
          $query="SELECT menus.precio, carritos.cantidad, carritos.id, carritos.menu
          FROM carritos, menus
          WHERE carritos.menu=menus.id AND carritos.user='$id'";
          $carritos=DB::select($query);

          foreach ($carritos as $row) {
            $pedidodetalle = New Pedidodetalle;
            $pedidodetalle->pedido=$pedido->id;
            $pedidodetalle->menu=$row->menu;
            $pedidodetalle->cantidad=$row->cantidad;
            $pedidodetalle->precio=$row->precio;
            $pedidodetalle->save();
            $query="SELECT complementos.adicional, adicionales.nombre, adicionales.precio
            FROM complementos, adicionales
            WHERE complementos.adicional=adicionales.id and complementos.carrito='$row->id'";
            $complementos=DB::select($query);

            foreach ($complementos as $complemento) {
              $pedidocomplemento = New Pedidocomplemento;
              $pedidocomplemento->pedido=$pedido->id;
              $pedidocomplemento->pedidodetalle=$pedidodetalle->id;
              $pedidocomplemento->nombre=$complemento->nombre;
              $pedidocomplemento->precio=$complemento->precio;
              $pedidocomplemento->save();
            }
          }

          //se crean los adicionales

          //se vacia el carrito

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        $user = User::find($pedido->user);
        $negocio = Negocio::find($pedido->negocio);
//        $complementos=Pedidocomplemento::where('pedido', '=', $pedido->id);
        $query="SELECT * from pedidocomplementos where pedido='$pedido->id'";
        $complementos=DB::select($query);

        $query="SELECT pd.id, pd.cantidad, pd.precio, m.nombre, m.foto
          FROM pedidodetalles as pd, menus as m
          WHERE pd.menu=m.id and pd.pedido='$pedido->id'";
//          echo $query;
          $detalles=DB::select($query);

        return view('pedidos.show',compact('pedido','user','negocio','detalles','complementos'));
    }

    public function mostrar(Request $request)
    {
        $pedido = Pedido::find($request->id);
        $user = User::find($pedido->user);
        $negocio = Negocio::find($pedido->negocio);
//        $complementos=Pedidocomplemento::where('pedido', '=', $pedido->id);
        $query="SELECT * from pedidocomplementos where pedido='$pedido->id'";
        $complementos=DB::select($query);

        $query="SELECT pd.id, pd.cantidad, pd.precio, m.nombre, m.foto
          FROM pedidodetalles as pd, menus as m
          WHERE pd.menu=m.id and pd.pedido='$pedido->id'";
//          echo $query;
          $detalles=DB::select($query);

        return view('pedidos.show',compact('pedido','user','negocio','detalles','complementos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    //*******************************************************
         public function sendPush($user,$mensaje)
           {
              $query="select token from users where id='$user'";
              $user=DB::select($query);

               $data = [
                   "to" => $user[0]->token,
                   "notification" =>
                       [
                           "title" => 'PidemeOnLine',
                           "body" => $mensaje,
                           "icon" => url('https://pidemeonline.com/img/logo.png')
                       ],

               ];
               $dataString = json_encode($data);

               $headers = [
                   'Authorization: key=AAAARmipiS8:APA91bHSK4p6e09kFsPzL4f-OzksS8TolrvPItiNMzRBpgnMnpHTkPVQWFzOZfr1XJkBOtFnLQITZuFJ2SjeR3G9il0MpIYJYnPv1EIv1V02e62h8YQljbnJOwy9GBFJH_Xmoj61QrMe',
                   'Content-Type: application/json',
               ];

               $ch = curl_init();

               curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
               curl_setopt($ch, CURLOPT_POST, true);
               curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

               curl_exec($ch);

               //return redirect('/')->with('message', 'Notification sent!');
           }

    //********************************************************************************




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido,$pedidoid)
    {
      // dump($request->estatus);
      // dd($pedidoid);
      // $pedido->update($request->all());     
      $cur_pedido = Pedido::find($pedidoid);
      $cur_pedido->estatus = $request->estatus;
      $cur_pedido->save();
      if($request->estatus=="ASIGNADO"){
          $id=Auth::id();
          $envio = New Envio;
          $envio->chofer=$id;
          if(!empty($pedidoid))
          {
            $envio->pedido=$pedidoid;
          }
          else
          {
            $envio->pedido=$pedido->id;
          }          
          $envio->save();
      }
      else {
        $this->sendPush($cur_pedido->user,"Su pedido ".$pedidoid." ha cambiado de Estatus a: ".$request->estatus);
      }



      return redirect()->route('pedidos.index')
          ->with('message','Estatus actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }

    public function comprobante(Request $request)
    {
      $pedido = Pedido::find($request->id);
      return view('pedidos.comprobante',compact('pedido'));
    }
}
