<?php

namespace App\Http\Controllers;
use Intervention\Image\ImageManagerStatic as Image;
use App\Chat;
use DB;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function sala(Request $request)
    {
        $id=$request->id;
        return view('chats.index',compact('id'));
    }

    public function iniciar(Request $request)
    {
        $pedido=$request->id;
        $query="select chats.*, users.name from chats, users
        where chats.usuario=users.id
        AND pedido='$pedido' order by id DESC";
        $chats=DB::select($query);
        return view('chats.create',compact('chats','pedido'));
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

     public function remove_emoji($text){
           return preg_replace('/[[:^print:]]/', "", $text);
     }

    public function store(Request $request)
    {
        //echo $request->texto;
        $chat = New Chat;
        $chat->pedido=$request->pedido;
        $chat->usuario=$request->usuario;
        $chat->texto=$this->remove_emoji($request->texto);
        $chat->save();
        //Chat::create($request->all());
        return back();
    }

    public function guardar(Request $request)
    {
      $namefoto="";
      if($request->file('archivofoto')){
        $image       = $request->file('archivofoto');
        $filename    = time().$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
        $image_resize = Image::make($image->getRealPath());
        $image_resize->resize(300, 300);
        $image_resize->save(public_path('storage/app/public/uploads/' .$filename));
        $namefoto=$filename;
      }
        //echo $request->texto;
        $chat = New Chat;
        $chat->pedido=$request->pedido;
        $chat->usuario=$request->usuario;
        $chat->texto=$this->remove_emoji($request->texto);
        $chat->foto=$namefoto;
        $chat->save();

        $pedido=$request->pedido;;
        $query="select chats.*, users.name from chats, users
        where chats.usuario=users.id
        AND pedido='$pedido' order by id DESC";
        $chats=DB::select($query);

        //se ubica el usuario del pedido
        $query="SELECT p.user
            FROM pedidos p
            WHERE p.id='$request->pedido'";

        $usuario=DB::select($query);
        $this->sendPush($usuario[0]->user,"Nuevo mensaje para Pedido Nro. ".$request->pedido);

        //return view('chats.create',compact('chats','pedido'));
        return redirect('pedidos');

//        return view('chats.create',compact('chats','pedido'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
