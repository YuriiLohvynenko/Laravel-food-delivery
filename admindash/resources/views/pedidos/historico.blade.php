@extends('layout')

@section('content')
<div class="app-main__inner">

  <div class="app-page-title">
    <div class="page-title-wrapper">
      <div class="page-title-heading">
        <div class="page-title-icon">
          <i class="pe-7s-cart icon-gradient bg-mean-fruit">
          </i>
        </div>
        <div>Pedidos Dashboard
          <div class="page-title-subheading">Listado de pedidos
          </div>
        </div>

      </div>
      <div class="page-title-actions">

      </div>
    </div>
  </div>

  <div class="container">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-danger">Pedidos</h6>
    </div>
    <div class="card-body">
      <div class="food__category__wrapper mt--10">
        <div class="row">

          <!-- Start table -->
          <div class="table-content table-responsive bg-white">
            <table class="table table-bordered">
              <thead>
                <tr class="title-top bg-wa">
                  <th>Detalle</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pedidos as $row)
                <tr>
                  <td style="color:black;">
                    <img src="/deliverydash/public/storage/app/public/uploads/{{$row->logo}}" width="90px"
                      alt="Nombre del negocio"><br>
                    <h4>{{$row->nombre}}</h4>
                    <hr>
                    <h5 style="color:red;"> Pedido Nro. #{{$row->id}}</h5>
                    <form action="{{env('APP_URL')}}/pedido/mostrar" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{$row->id}}">
                      <button class="btn btn-outline-danger btn-xs" type="submit" name="button">
                        <i class="fa fa-file-invoice-dollar"></i> Mostrar
                      </button>
                    </form>
                    <br>
                    <label class="bg-light">Fecha: {{date('d/m/Y',strtotime($row->created_at))}}</label><br>

                    @switch($row->estatus)
                    @case("PENDIENTE")
                    <label class="bg-warning"><strong>Estatus: {{$row->estatus}}</strong>
                      <i class="fas fa-spinner fa-spin"></i>
                    </label>
                    <div class="alert alert-dark" role="alert">
                      <b>Por favor aceptar, para que el cliente proceda a hacer el pago</b>
                    </div>
                    @break
                    @case("ACEPTADO")
                    <label class="bg-warning"><strong>Estatus: {{$row->estatus}}</strong>
                      <i class="fas fa-spinner fa-spin"></i>
                    </label>
                    <div class="alert alert-dark" role="alert">
                      <b>Esperando pago del cliente</b>
                    </div>
                    @break
                    @case("PAGADO")
                    <label class="bg-warning"><strong>Estatus: {{$row->estatus}}</strong>
                      <i class="fas fa-spinner fa-spin"></i>
                    </label>
                    <form class="" action="{{env('APP_URL')}}/comprobante" method="post">
                      @csrf
                      <input type="hidden" name="id" value="{{$row->id}}">
                      <button class="btn btn-primary" type="submit" name="button">Ver comprobante</button>
                    </form>
                    <div class="alert alert-dark" role="alert">
                      <b>Por favor validar el pago y comenzar la preparación</b>
                    </div>
                    @break
                    @case("APROBADO")
                    <label class="bg-warning"><strong>Estatus: {{$row->estatus}}</strong>
                      <i class="fas fa-spinner fa-spin"></i>
                    </label>
                    <div class="alert alert-dark" role="alert">
                      <b>Por favor inicie la preparación del pedido e indique cuando haya sido entregado al delivery</b>
                    </div>
                    <form action="{{ route('pedidos.update',$row->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="estatus" value="DESPACHADO">
                      <button class="btn btn-primary" type="submit" name="button">Indicar Entregado al Delivery</button>
                    </form>
                    @break
                    @case("DESPACHADO")
                    <label class="bg-success"><strong>Estatus: {{$row->estatus}}</strong>
                      <i class="fas fa-spinner"></i>
                    </label>
                    <div class="alert alert-success" role="alert">
                      <b>Entregado al Delivery para entrega</b>
                    </div>
                    @break
                    @case("CANCELADO")
                    <label class="bg-secondary"><strong>Estatus: {{$row->estatus}}</strong>
                    </label>
                    <div class="alert alert-dark" role="alert">
                      El pedido fue cancelado<br> <b>Motivo:</b> {{$row->instrucciones}}
                    </div>
                    @break
                    @case("EXPIRADO")
                    <label class="bg-secondary"><strong>Estatus: {{$row->estatus}}</strong>
                    </label>
                    <div class="alert alert-secondary" role="alert">
                      <b>No se recibió respuesta por parte de su negocio</b>
                    </div>
                    @break
                    @case("ENTREGADO")
                    <label class="bg-success"><strong>Estatus: {{$row->estatus}}</strong>
                    </label>
                    <div class="alert alert-success" role="alert">
                      <b>Tu opinión sobre el cliente es importante</b>
                      @if($row->votocliente==0)
                      <form class="" action="valorar" method="post">
                        @csrf
                        <input type="hidden" name="usuario" value="{{$row->user}}">
                        <input type="hidden" name="pedido" value="{{$row->id}}">
                        <button class="btn btn-success" type="submit" name="button">
                          Calificar al Cliente
                        </button>
                      </form>
                      @endif
                    </div>
                    @break
                    @endswitch
                  </td>
                  <td style="color:black;">{{$row->total}} {{$row->moneda}}</td>
                </tr>
                @endforeach
                <tr>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- FIN table-->

        </div>
      </div>



    </div>
  </div>

  @endsection