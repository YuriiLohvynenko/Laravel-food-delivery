@extends('layout')
@section('content')

<!-- Start Service Area -->
  <section class="food__service bg--white section-padding--lg">
    <div class="section__title service__align--center bg-danger">
        <!--<p>the process of our service</p>-->
        <h1 style="color:white;">Comercios Afiliados</h1>
    </div>
      <div class="container service__container">
          <div class="row">
              <!-- Start Single Service -->
              @foreach($negocios as $row)
              <div class="single__food__list d-flex wow fadeInUp">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="food__list__details">

                        <div class="food__rating1 text-center">
                            <div class="list__food__prize1 text-center">
                                <span>{{$row->nombre}}</span>
                            </div>
                            <ul class="rating">
                                <img src="/deliverydash/public/storage/app/public/uploads/{{$row->logo}}" width="150" alt="Foto del Negocio">
                            </ul>
                        </div>
                        <h2>
                          @if($row->estatus)
                            <a class="food__btn grey--btn theme--hover" href="{{env('APP_URL')}}/menu/{{$row->id}}">VER MENÚ</a>
                          @else
                            <button type="button" class="btn btn-danger xs">CERRADO</button>
                          @endif

                          <a href="{{env('APP_URL')}}/detalle/{{$row->id}}">
                            <button class="btn"><i class="zmdi zmdi-pin-drop" style="font-size:20px;color:red;"></i> UBICACIÓN</button>
                          </a>
                        </h2>
                    </div>
                </div>
                  <div class="food__list__thumb">
                      <a>
                          <img src="/deliverydash/public/storage/app/public/uploads/{{$row->foto}}" alt="Foto del Negocio">
                      </a>
                  </div>

              </div>
              @endforeach
              <!-- Start Single Service -->
          </div>
      </div>
  </section>
  
  <!-- End Service Area -->

@endsection
