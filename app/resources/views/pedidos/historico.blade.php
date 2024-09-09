@extends('layout')

@section('content')
<style media="screen">
@import url(https://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);
*{
  margin: 0;
  padding: 0;
  font-family: roboto;
}

body{
  background: #000;
}

.cont{
  width: 93%;
  max-width: 350px;
  text-align: center;
  margin: 4% auto;
  padding: 30px 0;
  background: #111;
  color: #EEE;
  border-radius: 5px;
  border: thin solid #444;
  overflow: hidden;
}

hr{
  margin: 20px;
  border: none;
  border-bottom: thin solid rgba(255,255,255,.1);
}

div.title{
  font-size: 2em;
}

h1 span{
  font-weight: 300;
  color: #Fd4;
}

div.stars{
  width: 270px;
  display: inline-block;
}

input.star{
  display: none;
}

label.star {
  float: right;
  padding: 10px;
  font-size: 26px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content:'\f005';
  color: #FD4;
  transition: all .25s;
}


input.star-5:checked ~ label.star:before {
  color:#FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before {
  color: #F62;
}

label.star:hover{
  transform: rotate(-15deg) scale(1.3);
}

label.star:before{
  content:'\f006';
  font-family: FontAwesome;
}

.rev-box{
  overflow: hidden;
  height: 0;
  width: 100%;
  transition: all .25s;
}

textarea.review{
  background: #222;
  border: none;
  width: 100%;
  max-width: 100%;
  height: 100px;
  padding: 10px;
  box-sizing: border-box;
  color: #EEE;
}

label.review{
  display: block;
  transition:opacity .25s;
}



input.star:checked ~ .rev-box{
  height: 125px;
  overflow: visible;
}






</style>
<!-- Start Food Category -->
<section class="food__category__area bg--white section-padding--sm">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="section__title service__align--center bg-danger">
                    <h1 style="color:white;">TUS PEDIDOS ANTERIORES</h1>
                </div>
            </div>
        </div>
        <div class="food__category__wrapper mt--10">
            <div class="row">

              <!-- Start table -->
              <div class="table-content table-responsive">
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
                              <img src="/deliverydash/public/storage/app/public/uploads/{{$row->logo}}" width="90px" alt="Nombre del negocio"><br>
                              <h4>{{$row->nombre}}</h4>
                              <hr>
                              <h4 style="color:red;">Pedido Nro. {{$row->id}}</h4>
                              <form action="{{env('APP_URL')}}/pedido/mostrar" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$row->id}}">
                                <button class="btn btn-outline-danger btn-sm" type="submit" name="button">
                                  <i class="zmdi zmdi-assignment"></i> Mostrar
                                </button>
                              </form>
                              <!--
                              <a class="btn btn-danger btn-sm" href="{{env('APP_URL')}}/pedidos/{{$row->id}}">
                                <i class="zmdi zmdi-assignment"></i> Mostrar
                              </a>
                            -->
                              <hr>
                              <label class="bg-light">Fecha: {{date('d/m/Y h:m A',strtotime($row->created_at))}}</label><br>
                              @switch($row->estatus)
                                @case("PENDIENTE")
                                  <label class="bg-warning"><strong>Estatus: {{$row->estatus}}</strong>
                                    <i class="zmdi zmdi-spinner zmdi-hc-spin"></i>
                                  </label>
                                  <div class="alert alert-dark" role="alert">
                                    <b>En espera de aceptación del pedido</b>
                                  </div>
                                 @break
                                 @case("ACEPTADO")
                                   <label class="bg-warning"><strong>Estatus: {{$row->estatus}}</strong>
                                     <i class="zmdi zmdi-spinner zmdi-hc-spin"></i>
                                   </label>
                                   <div class="alert alert-dark" role="alert">
                                     <b>Por favor proceder a realizar el pago</b>
                                   </div>
                                   <a class="btn btn-success" href="{{env('APP_URL')}}/pedido/{{$row->id}}/pagar">
                                     <b>Registrar pago</b>
                                   </a>
                                  @break
                                  @case("PAGADO")
                                    <label class="bg-warning"><strong>Estatus: {{$row->estatus}}</strong>
                                      <i class="zmdi zmdi-spinner zmdi-hc-spin"></i>
                                    </label>
                                    <div class="alert alert-dark" role="alert">
                                      <b>En espera de que el negocio valide el pago</b>
                                    </div>
                                   @break
                                   @case("APROBADO")
                                     <label class="bg-success"><strong>Estatus: {{$row->estatus}}</strong>
                                       <i class="zmdi zmdi-spinner zmdi-hc-spin"></i>
                                     </label>
                                     <div class="alert alert-success" role="alert">
                                       <b>Ya tu pedido esta preparándose</b>
                                     </div>
                                    @break
                                    @case("DESPACHADO")
                                      <label class="bg-success"><strong>Estatus: {{$row->estatus}}</strong>
                                      </label>
                                      <div class="alert alert-success" role="alert">
                                        <b>Ya tu pedido ha sido enviado</b>
                                      </div>
                                     @break
                                     @case("CANCELADO")
                                       <label class="bg-secondary"><strong>Estatus: {{$row->estatus}}</strong>
                                       </label>
                                       <div class="alert alert-secondary" role="alert">
                                         Este pedido fue cancelado.<br>
                                         <b>Motivo: {{$row->instrucciones}}</b>
                                       </div>
                                      @break
                                      @case("EXPIRADO")
                                        <label class="bg-secondary"><strong>Estatus: {{$row->estatus}}</strong>
                                        </label>
                                        <div class="alert alert-secondary" role="alert">
                                          <b>No se recibió respuesta por parte del negocio</b>
                                        </div>
                                       @break
                                      @case("ENTREGADO")
                                        <label class="bg-success"><strong>Estatus: {{$row->estatus}}</strong>
                                        </label>
                                        <div class="alert alert-success" role="alert">
                                          <b>Tu opinión es importante</b>
                                          <!-- CALIFICACION PEDIDO -->
                                          @if($row->votonegocio==0)
                                          <form action="{{ route('valoraciones.store') }}" method="POST">
                                              @csrf
                                            <a class="btn btn-success" href="#"  data-toggle="modal" data-target="#exampleModal{{$row->id}}">
                                                Calificar Pedido
                                            </a>
                                            <input type="hidden" name="pedido" value="{{$row->id}}">
                                            <input type="hidden" name="usuario" value="{{$row->negocio}}">
                                            <input type="hidden" name="tipo" value="0">
                                            <!-- modal -->
                                            <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Tu opinión es importante</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <h5 style="color:black;">¿Estuviste conforme con el pedido?</h5>
                                                    <div class="cont">
                                                    <div class="stars">
                                                    <!--<form action="">-->
                                                      <input required class="star star-5" id="star-5-{{$row->id}}" type="radio" name="rating" value="5"/>
                                                      <label class="star star-5" for="star-5-{{$row->id}}"></label>
                                                      <input class="star star-4" id="star-4-{{$row->id}}" type="radio" name="rating" value="4"/>
                                                      <label class="star star-4" for="star-4-{{$row->id}}"></label>
                                                      <input class="star star-3" id="star-3-{{$row->id}}" type="radio" name="rating" value="3"/>
                                                      <label class="star star-3" for="star-3-{{$row->id}}"></label>
                                                      <input class="star star-2" id="star-2-{{$row->id}}" type="radio" name="rating" value="2"/>
                                                      <label class="star star-2" for="star-2-{{$row->id}}"></label>
                                                      <input class="star star-1" id="star-1-{{$row->id}}" type="radio" name="rating" value="1"/>
                                                      <label class="star star-1" for="star-1-{{$row->id}}"></label>
                                                      <div class="rev-box">
                                                        <textarea class="review" col="30" name="comentario"></textarea>
                                                        <label class="review" for="review">Deja tu comentario</label>
                                                      </div>
                                                    <!--</form>-->
                                                    </div>
                                                    </div>

                                                    <hr>
                                                    <br>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success">Enviar</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- modal -->
                                          </form>
                                          @endif
                                          <!-- CALIFICACION PEDIDO -->
                                          <br>
                                          <!-- CALIFICACION DELIVERY -->
                                          @if($row->votodelivery==0)
                                          <form action="{{ route('valoraciones.store') }}" method="POST">
                                              @csrf
                                            <a class="btn btn-warning" href="#"  data-toggle="modal" data-target="#deliveryModal{{$row->id}}">
                                                Calificar Delivery
                                            </a>
                                            <!-- modal -->
                                            <div class="modal fade" id="deliveryModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Tu opinión es importante</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <h5 style="color:black;">¿Estuviste conforme con el Delivery?</h5>
                                                    <input type="hidden" name="pedido" value="{{$row->id}}">
                                                    <input type="hidden" name="usuario" value="0">
                                                    <input type="hidden" name="tipo" value="1">
                                                    <div class="cont">
                                                    <div class="stars">
                                                    <!--<form action="">-->
                                                      <input required class="star star-5" id="star-5-2{{$row->id}}" type="radio" name="rating" value="5"/>
                                                      <label class="star star-5" for="star-5-2{{$row->id}}"></label>
                                                      <input class="star star-4" id="star-4-2{{$row->id}}" type="radio" name="rating" value="4"/>
                                                      <label class="star star-4" for="star-4-2{{$row->id}}"></label>
                                                      <input class="star star-3" id="star-3-2{{$row->id}}" type="radio" name="rating" value="3"/>
                                                      <label class="star star-3" for="star-3-2{{$row->id}}"></label>
                                                      <input class="star star-2" id="star-2-2{{$row->id}}" type="radio" name="rating" value="2"/>
                                                      <label class="star star-2" for="star-2-2{{$row->id}}"></label>
                                                      <input class="star star-1" id="star-1-2{{$row->id}}" type="radio" name="rating" value="1"/>
                                                      <label class="star star-1" for="star-1-2{{$row->id}}"></label>
                                                      <div class="rev-box">
                                                        <textarea class="review" col="30" name="comentario"></textarea>
                                                        <label class="review" for="review">Deja tu comentario</label>
                                                      </div>
                                                    <!--</form>-->
                                                    </div>
                                                    </div>

                                                    <hr>
                                                    <br>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success">Enviar</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- modal -->
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
</section>

<!-- End Food Category -->
@endsection
