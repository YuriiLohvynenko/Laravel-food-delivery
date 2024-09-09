@extends('layout')
@section('content')
<div class="app-main__inner">

<div class="container">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-danger">Comprobante Pedido Nro. {{$pedido->id}}</h6>
  </div>
  <div class="card-body">
    <div class="food__category__wrapper mt--10">
      <div class="row">
        <div class="col">
            <h2>Método de Pago</h2>
            <pre>{{$pedido->metodo}}</pre>
        </div>
        @if($pedido->estatus=="PAGADO")
        <div class="col">
          <form action="{{env('APP_URL')}}/pedidos/update/{{$pedido->id}}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="estatus" value="APROBADO">
            <button type="submit" class="btn btn-success">Aprobar pago</button>
          </form>

        </div>
        @endif
        <div class="col">

          <form class="" action="{{env('APP_URL')}}/iniciarchat" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$pedido->id}}">
            <button type="submit" class="btn btn-primary">
              <i class="zmdi zmdi-comments"></i> Iniciar Chat
            </button>
            <a class="btn btn-info" href="{{env('APP_URL')}}/pedidos">
              Regresar
            </a>
          </form>
        </div>
      </div>
      <div class="row">
        <a href="/app/public/storage/app/public/uploads/{{ $pedido->comprobante }}" target="_blank">
          <img class="image img-fluid" src="/app/public/storage/app/public/uploads/{{ $pedido->comprobante }}"><br>
        </a>
      </div>
      @if($pedido->comprobante2)
      <div class="row">
        <a href="/app/public/storage/app/public/uploads/{{ $pedido->comprobante2 }}" target="_blank">
          <img class="image img-fluid" src="/app/public/storage/app/public/uploads/{{ $pedido->comprobante2 }}"><br>
        </a>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
