<?php

namespace App\Http\Controllers;

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

     public function remove_emoji($text){
           return preg_replace('/[[:^print:]]/', "", $text);
     }

    public function store(Request $request)
    {
        //echo $request->texto;
        $chat = New Chat;
        $chat->pedido=$request->pedido;
        $chat->usuario=$request->usuario;
        $chat->texto=$this->$this->remove_emoji($request->texto);
        $chat->save();
        //Chat::create($request->all());
        return back();
    }

    public function guardar(Request $request)
    {
        //echo $request->texto;
        $chat = New Chat;
        $chat->pedido=$request->pedido;
        $chat->usuario=$request->usuario;
        $chat->texto=$this->remove_emoji($request->texto);
        $chat->save();

        $pedido=$request->pedido;;
        $query="select chats.*, users.name from chats, users
        where chats.usuario=users.id
        AND pedido='$pedido' order by id DESC";
        $chats=DB::select($query);
        return view('chats.create',compact('chats','pedido'));

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
