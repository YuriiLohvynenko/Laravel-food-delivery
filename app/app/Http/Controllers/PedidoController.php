<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Intervention\Image\ImageManagerStatic as Image;



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
        $query="select pedidos.*, negocios.nombre, negocios.logo from pedidos, negocios
        where pedidos.negocio=negocios.id AND pedidos.user='$id'
        and (pedidos.estatus<>'CANCELADO' AND pedidos.estatus<>'ENTREGADO' AND pedidos.estatus<>'EXPIRADO')
        order by pedidos.id DESC";
        $pedidos=DB::select($query);        
        return view('pedidos.index',compact('pedidos'));
    }

    public function getuserorder()
    {
      $id=Auth::id();
        $query="select pedidos.*, negocios.nombre, negocios.logo from pedidos, negocios
        where pedidos.negocio=negocios.id AND pedidos.user='$id'
        and (pedidos.estatus<>'CANCELADO' AND pedidos.estatus<>'ENTREGADO' AND pedidos.estatus<>'EXPIRADO')
        order by pedidos.id DESC";
        $pedidos=DB::select($query);

        return response()->json($pedidos);
    }

    public function historicos()
    {

        $id=Auth::id();
        $query="select pedidos.*, negocios.nombre, negocios.logo from pedidos, negocios
        where pedidos.negocio=negocios.id AND pedidos.user='$id'
        and (pedidos.estatus='DESPACHADO' or pedidos.estatus='CANCELADO' or pedidos.estatus='ENTREGADO' or pedidos.estatus='EXPIRADO') order by pedidos.id DESC";
        $pedidos=DB::select($query);

        return view('pedidos.historico',compact('pedidos'));

    }

    public function view_delivery($id)
    {
      
      $query="select * from envios
        where envios.pedido='$id'";
      $cur_pos=DB::select($query);
      $cur_order = Pedido::find($id);   
      
      return view('pedidos.viewdelivery',compact('cur_pos','cur_order'));
    }
    public function getdelivery(Request $request)
    {
      $query="select * from envios
        where envios.pedido='$request->id'";
      $cur_pos=DB::select($query);
        
      return response()->json($cur_pos);
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

     public function remove_emoji($text){
           return preg_replace('/[[:^print:]]/', "", $text);
     }


    public function store(Request $request)
    {

        $id=Auth::id();
        //se actualiza el token
          $query="UPDATE users SET token = '$request->token' WHERE id = '$id'";
          DB::select($query);
        //fin token

        $instrucciones=$this->remove_emoji($request->instrucciones);

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
          $pedido->instrucciones=$instrucciones;
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

            //se vacia el carrito
            $id=Auth::id();
            $query="select id from carritos where user='$id'";
            $carritos=DB::select($query);

            foreach ($carritos as $row) {
              $query="delete from complementos where carrito='$row->id'";
              DB::select($query);
            }

            $query="delete from carritos where user='$id'";
            DB::select($query);
            //fin se vacia

            //se ubica el usuario dueño del negocio////////////////////////////////////
                      $query="select user from negocios where id='$pedido->negocio'";
                      $negocio=DB::select($query);
                      $this->sendPush($negocio[0]->user,"Pedido Nuevo en espera de Aceptación");
                      $this->push($negocio[0]->user,"Pedido Nuevo en espera de Aceptación");
            //************************************************

            return redirect('pedidos');

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

        $query="SELECT * from pedidocomplementos where pedido='$pedido->id'";
        $complementos=DB::select($query);

        $query="SELECT pd.id, pd.cantidad, pd.precio, m.nombre, m.foto
          FROM pedidodetalles as pd, menus as m
          WHERE pd.menu=m.id and pd.pedido='$pedido->id'";

          $detalles=DB::select($query);

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

        return view('pedidos.show',compact('pedido','user','negocio','detalles','complementos'));
    }

    public function mostrar(Request $request)
    {
        $pedido=Pedido::find($request->id);
        $user = User::find($pedido->user);
        $negocio = Negocio::find($pedido->negocio);

        $query="SELECT * from pedidocomplementos where pedido='$pedido->id'";
        $complementos=DB::select($query);

        $query="SELECT pd.id, pd.cantidad, pd.precio, m.nombre, m.foto
          FROM pedidodetalles as pd, menus as m
          WHERE pd.menu=m.id and pd.pedido='$pedido->id'";

          $detalles=DB::select($query);

          //busco la información de valoracion del negocio//
              $query="SELECT COUNT(*) as num FROM pedidos WHERE negocio='$negocio->id';";
              $ventas= DB::select($query);

              $query="SELECT sum(rating) as suma, count(id) as num FROM valoraciones
              WHERE usuario='$negocio->id' and tipo='0'";
              $valoraciones = DB::select($query);
              if($valoraciones[0]->num){
                $rating= round($valoraciones[0]->suma/$valoraciones[0]->num);
              }
              else{
                $rating=0;
              }
          //fin valoracion
          //busco la información de valoracion del cliente//
              $query="SELECT COUNT(*) as num FROM pedidos WHERE user='$pedido->user';";
              $compras= DB::select($query);

              $query="SELECT sum(rating) as suma, count(id) as num FROM valoraciones
              WHERE usuario='$pedido->user' and tipo='2'";
              $valoraciones = DB::select($query);
              if($valoraciones[0]->num){
                $ratingcli= round($valoraciones[0]->suma/$valoraciones[0]->num);
              }
              else{
                $ratingcli=0;
              }
          //fin valoracion
          //echo $query;
        return view('pedidos.show',compact('pedido','user','negocio','detalles','complementos','rating','ventas','compras','ratingcli'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */

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
                            "icon" => url('public/images/logo.png')
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

                return redirect('/')->with('message', 'Notification sent!');
            }

     //********************************************************************************
     //***************************************************************************
     //--WEBSITE TO APK API
     public function push($user,$mensaje)
     {
       /*
             $query="select token from users where id='$user'";
             $user=DB::select($query);

             $curl = curl_init();
             $payload = Array(
              'packageName' => "com.pidemeonline.app", //Required Parameter
              'type' => "Simple", //Optional Parameter (Default: Simple, Possible Values: Simple, Image)
              'title' => "PidemeOnLine", //Required Parameter
              'description' => $mensaje, //Optional
              'image' => "https://pidemeonline.com/img/logo.png", //Optional (Works only when type=Image)
              'url' => "https://pidemeonline.com/admindash/pedidos", //Optional (Must be a URL if given)
              'ring' => "RINGVIBE", //Optional (Default: RING, Possible Values: RING, VIBE, RINGVIBE, SILENT)
              // Further parameters described below for different APIs
              //Above Options are common for all requests.
              'deviceToken' => $user[0]->token //Required(Multiple Tokens comma seperated)
             );

             curl_setopt_array($curl, array(
               CURLOPT_URL => "https://websitetoapk.com/pushadmin/api/v1/send_individual", // As per your request
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
               CURLOPT_CUSTOMREQUEST => "POST",
               CURLOPT_POSTFIELDS => http_build_query($payload),
               CURLOPT_HTTPHEADER => array(
             	"content-type: application/x-www-form-urlencoded",
             	"X-Api-Key: Qc-hD7KjpwiRMfEorMLt7qGX2onJXvGieaJ7VZu5ebU",
             	"X-Auth-Token: a79a738d0f9b7ad70fbfdba37c2fc820"
               ),
             ));

             $response = curl_exec($curl);
             $err = curl_error($curl);
             curl_close($curl);

             if ($err) {
               echo "cURL Error #:" . $err;
             } else {
               echo $response;
             }
             */
     }
//**************************************************************************
    public function update(Request $request, Pedido $pedido)
    {
      $pedido->update($request->all());
      //se ubica el usuario dueño del negocio
      $query="select user from negocios where id='$pedido->negocio'";
      $negocio=DB::select($query);

      $this->sendPush($negocio[0]->user,"Pedido ha cambiado de Estatus a: ".$request->estatus);
      $this->push($negocio[0]->user,"Pedido ha cambiado de Estatus a: ".$request->estatus);

      return redirect()->route('pedidos.index');
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

    public function pagar($id)
    {
        $pedido = Pedido::find($id);
        //los metodos de pago del negocio
        $query="SELECT * FROM metodos WHERE negocio='$pedido->negocio'";
        $metodos=DB::select($query);
        return view('pedidos.pagar',compact('pedido','metodos'));
    }

    public function comprobante(Request $request)
    {

        $image       = $request->file('archivofoto');
        $filename    = time().$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('storage/app/public/uploads/' .$filename));
        $namefoto=$filename;

      $namefoto2="";
      if($request->file('archivofoto2')){
        $image       = $request->file('archivofoto2');
        $filename    = time().time().'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('storage/app/public/uploads/' .$filename));
        $namefoto2=$filename;
      }


        $pedido = Pedido::find($request->id);
        $pedido->metodo=$request->metodo;
        $pedido->estatus="PAGADO";
        $pedido->comprobante=$namefoto;
        $pedido->comprobante2=$namefoto2;
        $pedido->save();

        //se ubica el usuario dueño del negocio
        $query="select user from negocios where id='$pedido->negocio'";
        $negocio=DB::select($query);

        $this->sendPush($negocio[0]->user,"Pedido ".$pedido->id." ha cambiado de Estatus a: ".$pedido->estatus);
        //$this->push($negocio[0]->user,"Pedido ha cambiado de Estatus a: ".$pedido->estatus);



        return redirect()->route('pedidos.index')
          ->with('message','Pago registrado, espera tu entrega.');

    }

    public function vercomprobante(Request $request)
    {
      $pedido = Pedido::find($request->id);
      return view('pedidos.comprobante',compact('pedido'));
    }

//*******************prueba websitetoapk

public function prueba(){
//$token="dppvULaozag:APA91bHTEOv3kvMHb5Y-byn0AlzXcrxHUMsq_J3g3AjKyFmAYF4_Vk39-YBeLnKlyjE3XaRWEUCVc43Yvi1Y95E0bD1wm71FoP21HMbUsGUr9gNuG3QsVGZixBWhGsLy-okKzAFIDii1";
$token="de251189eaebb5f7";
  $curl = curl_init();
  $payload = Array(
   'packageName' => "com.pidemeonline.app", //Required Parameter
   'type' => "Simple", //Optional Parameter (Default: Simple, Possible Values: Simple, Image)
   'title' => "PidemeOnLine", //Required Parameter
   'description' => "Prueba de Mensaje a luis", //Optional
   'image' => "https://pidemeonline.com/img/logo.png", //Optional (Works only when type=Image)
//   'url' => "http://test.com", //Optional (Must be a URL if given)
   'ring' => "RINGVIBE", //Optional (Default: RING, Possible Values: RING, VIBE, RINGVIBE, SILENT)
   // Further parameters described below for different APIs
   //Above Options are common for all requests.
   'deviceToken' => $token //Required(Multiple Tokens comma seperated)
  );

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://websitetoapk.com/pushadmin/api/v1/send_individual", // As per your request
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($payload),
    CURLOPT_HTTPHEADER => array(
  	"content-type: application/x-www-form-urlencoded",
    "X-Api-Key: Qc-hD7KjpwiRMfEorMLt7qGX2onJXvGieaJ7VZu5ebU",
    "X-Auth-Token: a79a738d0f9b7ad70fbfdba37c2fc820"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }

/*
  $curl = curl_init();
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://websitetoapk.com/pushadmin/api/v1/list_apps",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
  	"content-type: application/x-www-form-urlencoded",
    "X-Api-Key: Qc-hD7KjpwiRMfEorMLt7qGX2onJXvGieaJ7VZu5ebU",
    "X-Auth-Token: a79a738d0f9b7ad70fbfdba37c2fc820"
    ),
  ));
  $response = curl_exec($curl);
  echo $response;
*/
}
//fin prueba

}
