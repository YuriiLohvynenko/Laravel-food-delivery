@extends('layout')
@section('content')
<div class="app-main__inner">

                        
<div class="section__title service__align--center bg-danger">
    <!--<p>the process of our service</p>-->
    <h1 style="color:white;">CHAT DEL PEDIDO NRO. {{$id}}</h1>
    <form class="" action="{{env('APP_URL')}}/iniciarchat" method="post">
      @csrf
      <input type="hidden" name="id" value="{{$id}}">
      <button type="submit" class="btn btn-primary">
        <i class="zmdi zmdi-comments"></i> Iniciar Chat
      </button>
    </form>

</div>
@endsection
