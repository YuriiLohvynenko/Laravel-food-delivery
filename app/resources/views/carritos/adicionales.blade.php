@extends('layout')

@section('content')
<!-- Start Bradcaump area -->
<div class="section__title service__align--center bg-danger">
    <!--<p>the process of our service</p>-->
    <h1 style="color:white;">ADICIONALES</h1>
</div>
        <div class="row">
            <div class="col-lg-12">
                <div class="fd__tab__content tab-content" id="nav-tabContent">
                    <!-- Start Single Content -->
                    <div class="food__list__tab__content tab-pane fade show active" id="nav-all" role="tabpanel">
                      <!-- Start Single Food -->
                        <div class="single__food__list d-flex wow fadeInUp">
                            <div class="food__list__thumb">
                                <a>
                                    <img src="/deliverydash/public/storage/app/public/uploads/{{$carrito[0]->foto}}" alt="Imagen Real del plato seleccionado">
                                </a>
                            </div>
                            <div class="food__list__inner d-flex align-items-center justify-content-between">
                                <div class="food__list__details">
                                    <h2><a>{{$carrito[0]->nombre}}</a></h2>
                                    <div>
                                        <div>
                                            <span style="color:black;">{{$carrito[0]->moneda}} {{$carrito[0]->precio}}</span>
                                            <font color="black">x {{$carrito[0]->cantidad}}</font> <span style="color:red">= {{$carrito[0]->moneda}} {{$carrito[0]->precio*$carrito[0]->cantidad}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- End Single Food -->
                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>

<div class="container">
  <h1 style="color:red;">Adicionales disponibles</h1>
  <form method="post" action="{{ env('APP_URL') }}/adicionales/agregarvarios">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$carrito[0]->id}}">
  <input type="checkbox" id="checkItem" name="check[]" value="0" checked style="visibility: hidden;">
  <div>
    <table class="table">
        <thead>
            <tr class="title-top">
                <th width="20px">
                </th>
                <th style="color:black;"><b>Selecciona lo que quieras agregar</b></th>
                <th class="product-remove"></th>
            </tr>
        </thead>
        <tbody>
          @foreach($adicionales as $row)
          <tr>
              <td class="product-name" width="20px">
                <input type="checkbox" id="checkItem" name="check[]" value="{{ $row->id }}">
              </td>
              <td class="product-price" style="color:black;">{{$row->nombre}} - {{$row->moneda}} {{$row->precio}}</td>
              <td class="product-remove"></td>
          </tr>
          @endforeach
        </tbody>
    </table>
  </div>

  <a href="{{env('APP_URL')}}/carrito">
    <button type="submit" class="btn btn-warning" name="button">Regresar al carrito</button>
  </a>
  <button type="submit" class="btn btn-success" name="button">Agregar Selección</button>
</form>
  <hr>
</div>


@endsection
