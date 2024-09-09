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

        <div class="col">

            <a class="btn btn-info" href="{{env('APP_URL')}}/pedidos">
              Regresar
            </a>

        </div>
      </div>
      <div class="row">
        <img class="image img-fluid" src="/app/public/storage/app/public/uploads/{{ $pedido->comprobante }}"><br>
      </div>
      @if($pedido->comprobante2)
      <div class="row">
        <img class="image img-fluid" src="/app/public/storage/app/public/uploads/{{ $pedido->comprobante2 }}"><br>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
