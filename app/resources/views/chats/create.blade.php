@extends('layout')
@section('content')
<style>
.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: lightblue;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}



.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}
</style>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="section__title service__align--center bg-danger">
            <!--<p>the process of our service</p>-->
            <h1 style="color:white;">Mensajes Pedido Nro. {{$pedido}}</h1>
        </div>
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col">
      <form action="{{env('APP_URL')}}/enviarchat" method="post" enctype="multipart/form-data">
        @csrf
          <h4>Usuario: {{Auth::user()->name}}</h4>
          <input type="hidden" name="pedido" value="{{$pedido}}">
          <input type="hidden" name="usuario" value="{{Auth::user()->id}}">
          <input type="text" name="texto" value="" required>
          <input class="btm btn-dark" type="file" name="archivofoto" class="form-control" accept="image/x-png,image/gif,image/jpeg">
          <br><br>
          <button class="btn btn-success" type="submit" name="button">Enviar</button>
          <a class="btn btn-primary" href="{{env('APP_URL')}}/pedidos">
            Regresar
          </a>
      </form>
    </div>
  </div>
<br><br>
<div class="row">
    <div class="col">
      <h4>Mensajes</h4>
      @foreach($chats as $row)
        @if($row->usuario==Auth::user()->id)
        <div class="container">
          <p><font color="black"><b>Tu:</b></font>
          <font color="black"><i>{{$row->texto}}</i></font></p>
          @if($row->foto)
            <img class="image img-fluid" src="/app/public/storage/app/public/uploads/{{ $row->foto }}"><br>
          @endif
        </div>
        @else
        <div class="container darker">
            <p><font color="darkblue"><b>{{$row->name}}:</b></font>
            <font color="black"><i>{{$row->texto}}</i></font></p>
            @if($row->foto)
              <img class="image img-fluid" src="/app/public/storage/app/public/uploads/{{ $row->foto }}"><br>
            @endif
        </div>
        @endif

      @endforeach
    </div>

</div>
</div>

@endsection
