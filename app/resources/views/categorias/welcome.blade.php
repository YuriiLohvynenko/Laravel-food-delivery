@extends('layout')
@section('content')
        <!-- Start Slider Area -->
        <div class="slider__area slider--one">
            <div class="slider__activation--1">
                <!-- Start Single Slide -->
                <div class="slide fullscreen bg-image--1">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="slider__content">
                                    <div class="slider__inner">

																			<!--
                                        <h2>“AAHAR”</h2>
                                        <h1>food delivery & service</h1>
																			-->
                                        <div class="slider__input">
                                            <form action="{{env('APP_URL')}}/negocios/buscar" method="post">
                                              {{ csrf_field() }}
                                              <input class="res__search" type="text" placeholder="Negocios, zonas" name="texto" required>
                                              <div class="src__btn">
                                                  <button type="submit" class="btn btn-warning">
                                                    <i class="zmdi zmdi-search"> Buscar</i>
                                                  </button>
                                              </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Slide -->
            </div>
        </div>
        <!-- End Slider Area -->
<br>
        <p align=center>
        <a href="{{env('APP_URL')}}/pedidos" class="btn" style="color:white;background-color:#D40C06;">
          Ver mis pedidos en curso
        </a>
      </p>
<br>
      <hr style="border: 1px solid red; border-radius: 0px;">

        <section>
          <div class="container">
              <h1 align="center" style="color:red;background-color:white;">Categorías</h1>
              <div class="row">
                @foreach($categorias as $row)
                <div class="col-6">
                      <a href="{{env('APP_URL')}}/negocioscat/{{$row->id}}">
                          <img src="/deliverydash/public/storage/app/public/uploads/{{$row->foto}}" width="200px" height="200px" alt="{{$row->nombre}}">
                      </a>
                      <h4 align="center" style="color:black;"><a href="{{env('APP_URL')}}/negocioscat/{{$row->id}}">{{$row->nombre}}</a></h4>
                </div>
                @endforeach
              </div>
          </div>
        </section>
        &nbsp;&nbsp;&nbsp;
        <!-- Start Food Category -->



        <!-- End Food Category -->

        <!-- Start Special Menu -->

        <section class="fd__special__menu__area bg-image--3 section-pt--lg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="section__title service__align--left">
													<!--
                            <p>the process of our service </p>
                            <h2 class="title__line">Restaurant with Special Menu</h2>
													-->
                        </div>
                    </div>
                </div>
            </div>

        </section>

			  <!-- End Special Menu -->
        <!-- Start Download App Area -->

        <!-- End Download App Area -->
        <!-- Start Testimonail Area -->

        <!-- End Testimonail Area -->
        <!-- Start Blog Area -->

        <!-- End Blog Area -->
        <!-- Start Subscribe Area -->
        <section class="fd__subscribe__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="subscribe__inner">
                            <!--<h2>Suscríbete para recibir ofertas</h2>-->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Subscribe Area -->
@endsection
