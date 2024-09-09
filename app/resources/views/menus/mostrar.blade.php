@extends('layout')
@section('content')
<!-- Start Bradcaump area -->
<div class="section__title service__align--center bg-danger">
    <!--<p>the process of our service</p>-->
    <h1 style="color:white;">MENÚ</h1>
</div>

<style media="screen">
#book-me {
  position: fixed;
  /*top: 50%;*/
  top:auto;
  bottom:0;
  right: 30%;
  /*transform: rotate(90deg) translateX(50%);*/
  transform-origin: 100% 0;
  z-index: 99999;
}
#book-me a {
  background: green;
  color: white;
  display: inline-block;
  font-size: 14px;
  font-weight: bold;
  text-transform: uppercase;
  font-family: montserrat;
  padding: 10px 30px;
}
@media screen and (max-width: 960px) {
  #book-me {
    bottom: 0;
    top: auto;
    transform: none;
  }
  #book-me a {
    padding: 10px 30px;
  }
}
</style>

<div id="book-me">
  <a href="{{env('APP_URL')}}/carrito">
    <h5><i class="zmdi zmdi-shopping-cart" style="color:red;"></i> Ver Carrito</h5>
  </a>
</div>


        <!-- Start Menu Grid Area -->
                <section class="food__menu__grid__area section-padding--lg">
                    <div class="container">
                        <div class="row">
                          <div class="col-lg-6 d-flex justify-content-center text-center">
                            <img src="/deliverydash/public/storage/app/public/uploads/{{$negocio[0]->logo}}" width="150" alt="list food images">
                          </div>
                          <div class="col-lg-6 d-flex justify-content-center text-center">
                            <h1 style="color:black;">{{$negocio[0]->nombre}}</h1>
                          </div>

                          @if(session()->has('message'))
                          <div class="alert alert-danger">
                            {{ session()->get('message') }}<br>
                          </div>
                          <div class="alert alert-warning">
                            ¿Quieres vaciar el carrito e iniciar un nuevo pedido?<br>
                            <a href="{{env('APP_URL')}}/carrito/vaciar">
                              <button class="btn btn-danger btn-block">PRESIONE AQUI PARA VACIAR EL CARRITO</button>
                            </a>
                          </div>
                          @endif
                          <div class="col-lg-12 d-flex justify-content-center text-center">

                            @for($i=0;$i<$rating;$i++)
                              <i class="zmdi zmdi-star zmdi-hc-3x" style="color:#ffe700"></i>
                            @endfor
                            @for($j=$i;$j<5;$j++)
                              <i class="zmdi zmdi-star zmdi-hc-3x"></i>
                            @endfor

                          </div>
                          <div class="col-lg-12 d-flex justify-content-center text-center bg-light">
                            <i class="zmdi zmdi-thumb-up zmdi-hc-lg" style="color:red;">{{$ventas[0]->num}}</i>


                            <!--
                            <a href="{{env('APP_URL')}}/carrito">
                              <h1><i class="zmdi zmdi-shopping-cart" style="color:red;"></i> Ver Carrito</h1>
                            </a>
                          -->
                          </div>

                        <div class="row mt--20">
                            <div class="col-lg-12">
                                <div class="fd__tab__content tab-content" id="nav-tabContent">
                                    <!-- Start Single Content -->
                                    <div class="food__list__tab__content tab-pane fade show active" id="nav-all" role="tabpanel">

                                        <!-- Start Single Food -->
                                        @foreach($menus as $row)
                                        <div class="single__food__list d-flex wow fadeInUp">
                                            <div class="food__list__thumb">
                                                <a>
                                                    <img src="/deliverydash/public/storage/app/public/uploads/{{$row->foto}}" alt="Imagen real del producto">
                                                </a>
                                            </div>
                                            <div class="food__list__inner d-flex align-items-center justify-content-between">
                                                <div class="food__list__details">
                                                    <h2><a>{{$row->nombre}}</a></h2>
                                                    <div class="food__rating1">
                                                        <div class="list__food__prize1">
                                                            <span>{{$row->moneda}} {{$row->precio}}</span>
                                                        </div>
                                                        <ul class="rating">
                                                          @for($i=0;$i<$row->votacion;$i++)
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                          @endfor
                                                          @for($j=$i;$j<5;$j++)
                                                            <li class="rating__opasity"><i class="zmdi zmdi-star"></i></li>
                                                          @endfor

                                                        </ul>
                                                    </div>
                                                    <div class="bg-light" style="width:90%">
                                                      {{$row->descripcion}}
                                                    </div>
                                                    <div class="list__btn">
                                                      @if($row->disponible)
                                                        <form action="{{ route('carritos.store') }}" method="POST">
                                                          @csrf
                                                          <input type="hidden" name="negocio" value="{{$negocio[0]->id}}">
                                                          <input type="hidden" name="menu" value="{{$row->id}}">
                                                          <input type="hidden" name="user" value="{{ Auth::id() }}">
                                                          Cant.
                                                          <i class="zmdi zmdi-minus-circle zmdi-hc-2x" style="color:red;" onclick="restarcantidad(cantidad{{$row->id}})"></i>
                                                          <input id="cantidad{{$row->id}}" type="number" name="cantidad" pattern="[-+]?[1-9]" min="1" max="99" step="1" value="1" size="2">
                                                          <i class="zmdi zmdi-plus-circle zmdi-hc-2x" style="color:red;" onclick="addcantidad(cantidad{{$row->id}})"></i>
                                                          <a class="food__btn grey--btn theme--hover">
                                                            <button class="btn bth-danger">Agregar al Carrito</button>
                                                          </a>

                                                        </form>
                                                      @else
                                                        <button type="button" class="btn btn-danger xs">AGOTADO</button>
                                                      @endif

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @endforeach
                                        <!-- End Single Food -->
                                    </div>
                                    <!-- End Single Content -->
                                </div>
                            </div>
                        </div>
                    </div>


                </section>

                <div class="col-lg-12 d-flex justify-content-center text-center bg-warning">
                  <!--
                  <a href="{{env('APP_URL')}}/carrito">
                    <h1><i class="zmdi zmdi-shopping-cart" style="color:red;"></i> Ver Carrito</h1>
                  </a>
                -->
                </div>

                <!-- End Menu Grid Area -->

                <script type="text/javascript">
                  function addcantidad(id) {
                    id.value=parseInt(id.value)+1;
                  }
                  function restarcantidad(id) {
                    if (id.value>0) {
                      id.value=parseInt(id.value)-1;
                    }
                  }
                </script>

@endsection
