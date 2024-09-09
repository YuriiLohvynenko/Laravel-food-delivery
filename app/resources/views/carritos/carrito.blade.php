@extends('layout2')
@section('content')
<!-- Start Bradcaump area -->
<div class="section__title service__align--center bg-danger">
    <!--<p>the process of our service</p>-->
    <h1 style="color:white;">CARRITO DE COMPRAS</h1>
</div>
<!--
        <div class="ht__bradcaump__area bg-image--19">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center brad__white">
                                <h2 class="bradcaump-title">Carrito de Compras</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="{{env('APP_URL')}}">Inicio</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                  <span class="breadcrumb-item active">Carrito</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      -->
        <!-- End Bradcaump area -->

        <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                        <!--<form action="#">-->
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-name">Menú</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @php $moneda=""; $TOTALcomplementos=0; @endphp
                                      @if(isset($carritos))
                                      @foreach($carritos as $row)
              												@php $moneda=$row->moneda; $negocio=$row->negocio; @endphp
                                        <tr>
                                            <td class="product-name">
                                              <img src="/deliverydash/public/storage/app/public/uploads/{{$row->foto}}" width="100" alt="list food images"><br>
                                              <a>{{$row->nombre}}</a><br>
                                              <h4 style="color:red">{{$row->moneda}} {{$row->precio}}</h4>
                                              <hr>
                                              <h5 style="color:black;">Cantidad: {{$row->cantidad}}</h5>
                                              <hr>
                                              <a href="{{env('APP_URL')}}/adicionales/{{$row->id}}">
                                                <button class="btn btn-danger btn-sm" type="button" name="button">Agregar adicionales</button>
                                              </a>
                                              <hr>
                                              <br>
                                              @if(isset($complementos))
                                              <div class="">
                                                @php $totalcomplementos=0; @endphp
                                                @foreach($complementos as $complemento)
                                                  @if($complemento->carrito==$row->id)
                                                  <form action="{{ route('complementos.destroy',$complemento->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger py-0 px-1" style="font-size: 0.7em;">
                                                        x
                                                    </button>
                                                    <font color="black">{{$complemento->nombre}}</font> - <font color="red">{{$complemento->moneda}} {{$complemento->precio}}</font><hr>
                                                    @php $totalcomplementos=$totalcomplementos+$complemento->precio; @endphp
                                                  </form>
                                                  @endif
                                                @endforeach
                                              </div>
                                              @endif
                                            </td>

                                            <td class="product-subtotal" >
                                              @php
                                                $subtotal=($row->precio+$totalcomplementos)*$row->cantidad;
                                                $TOTALcomplementos=$TOTALcomplementos+$subtotal;
                                                echo "<font color='black'>$".$subtotal."</font>";
                                              @endphp
                                            </td>
                                            <td class="product-remove">
                                              <form action="{{ route('carritos.destroy',$row->id) }}" method="POST">
                  															@csrf
                                              	@method('DELETE')
                                                <button type="submit" class="btn btn-link">
                                                    <i class="zmdi zmdi-delete" style="color:red;"></i>
                                                </button>
                                              </form>
                                            </td>
                                        </tr>
                                      @endforeach
                                      @endif
                                    </tbody>
                                </table>
                            </div>
                        <!--</form>-->
                    </div>
                </div>
                <br><hr>
                <div class="row">
                  <div class="col-lg-12 d-flex justify-content-center text-center">
                    <a href="{{env('APP_URL')}}/menu/{{$negocio}}">
                      <button class="btn btn-warning"><i class="zmdi zmdi-undo"></i> Regresar al menú</button>
                    </a>
                    <a href="{{ route('pedidos.create') }}">
                      <button class="btn btn-success">Aceptar y continuar <i class="zmdi zmdi-shopping-cart"></i> </button>
                    </a>
                  </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">

                            <div class="cart__total__amount">
                                <span>Total</span>
                                <span>{{$moneda}} {{number_format($TOTALcomplementos,2, "." , ",")}}</span>
                            </div>
                            <div class="cartbox-total d-flex justify-content-between">
                                  <ul class="cart__total__list">
                                      <li>Tasa/cambio:<font color="red">(*)</font></li>
                                      <li>Total Bs.</li>
                                  </ul>
                                  <ul class="cart__total__tk">
                                      <li>Bs. {{number_format($datosnegocio[0]->tasadecambio,2, "." , ",")}}</li>
                                      <li>{{number_format($TOTALcomplementos*$datosnegocio[0]->tasadecambio,2, "." , ",")}}</li>
                                  </ul>

                              </div>
                              <font color="red">(*)</font>Tasa de cambio establecida por el negocio
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <br>

              <a href="{{env('APP_URL')}}/carrito/vaciar">
                <button class="btn btn-dark btn-block">PRESIONE AQUI PARA VACIAR EL CARRITO</button>
              </a>
              <br>
              <div class="row">
                <div class="col-lg-12 d-flex justify-content-center text-center">
                  <a href="{{env('APP_URL')}}/menu/{{$negocio}}">
                    <button class="btn btn-warning"><i class="zmdi zmdi-undo"></i> Regresar al menú</button>
                  </a>
                  <a href="{{ route('pedidos.create') }}">
                    <button class="btn btn-success">Aceptar y continuar <i class="zmdi zmdi-shopping-cart"></i> </button>
                  </a>
                </div>
              </div>
        </div>

        <!-- cart-main-area end -->


@endsection
