@extends('layout')

@section('content')
<!-- Start Food Category -->
<section class="food__category__area bg--white section-padding--sm">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="section__title service__align--center bg-danger">
                    <!--<p>the process of our service</p>-->
                    <h1 style="color:white;">Categorías</h1>
                </div>
            </div>
        </div>
        <div class="food__category__wrapper mt--10">
            <div class="row">

              <!-- Start Single Category -->
              @foreach($categorias as $row)
              <div class="col-lg-4 col-md-6 col-sm-12">
                  <div class="food__item foo">
                      <div class="food__thumb">
                          <a href="{{env('APP_URL')}}/negocioscat/{{$row->id}}">
                              <img src="/deliverydash/public/storage/app/public/uploads/{{$row->foto}}" width="370" height="401" alt="{{$row->nombre}}">
                          </a>
                      </div>
                      <div class="food__title">
                          <h2><a href="{{env('APP_URL')}}/negocioscat/{{$row->id}}">{{$row->nombre}}</a></h2>
                      </div>
                  </div>
              </div>
              @endforeach

            </div>
        </div>
    </div>
</section>
<!-- End Food Category -->
@endsection
