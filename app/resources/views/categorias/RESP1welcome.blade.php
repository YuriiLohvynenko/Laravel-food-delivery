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
        <p align=center>
        <a href="{{env('APP_URL')}}/pedidos" class="btn btn-dark" style="color:white;">
          Ver mis pedidos en curso
        </a>
      </p>
        <!-- Start Service Area -->
<!--
        <section class="fd__service__area bg-image--2 section-padding--xs">
            <div class="container">
                <div class="service__wrapper bg--white">
                  <h1 style="color:red;">¿Cómo funciona?</h1>
                    <div class="row mt--1">
                        <!-- Start Single Service -->
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="service">
                                <div class="service__title">
                                    <div class="ser__icon">
																			<!--
                                        <img src="{{ asset ('public/images/icon/color-icon/1.png')}}" alt="icon image">
																			-->
																			<i class="zmdi zmdi-store" style="font-size:60px;color:red;"></i>
																		</div>
                                    <h2><a>Elige tu restaurante</a></h2>
                                </div>
                                <div class="service__details">
                                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>-->
                                </div>
                            </div>
                        </div>
                        <!-- End Single Service -->
                        <!-- Start Single Service -->
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="service">
                                <div class="service__title">
                                    <div class="ser__icon">
																			<!--
                                        <img src="{{ asset ('public/images/icon/color-icon/2.png')}}" alt="icon image">
																			-->
																			<i class="zmdi zmdi-cutlery" style="font-size:60px;color:red;"></i>
																		</div>
                                    <h2><a>Haz tu pedido</a></h2>
                                </div>
                                <div class="service__details">
                                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="service">
                                <div class="service__title">
                                    <div class="ser__icon">
																			<!--
                                        <img src="{{ asset ('public/images/icon/color-icon/2.png')}}" alt="icon image">
																			-->
																			<i class="zmdi zmdi-money" style="font-size:60px;color:red;"></i>
																		</div>
                                    <h2><a>Registra tu pago</a></h2>
                                </div>
                                <div class="service__details">
                                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>-->
                                </div>
                            </div>
                        </div>
                        <!-- End Single Service -->
                        <!-- Start Single Service -->
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <div class="service">
                                <div class="service__title">
                                    <div class="ser__icon">
																			<!--
                                        <img src="{{ asset ('public/images/icon/color-icon/3.png')}}" alt="icon image">
																			-->
																			<i class="zmdi zmdi-seat" style="font-size:60px;color:red;"></i>
																		</div>
                                    <h2><a>Recibe cómodamente</a></h2>
                                </div>
                                <div class="service__details">
                                    <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>-->
                                </div>
                            </div>
                        </div>
                        <!-- End Single Service -->
                    </div>
                </div>
            </div>
        </section>
-->
        <!-- End Service Area -->

        <section>
          <div class="container">
              <h1 style="color:red;">Categorías</h1>
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
        <section class="food__download__app__area section-padding--sm bg--white bg__shape--1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="section__title service__align--left">
                            <!--<p>the process of our service </p>-->
                            <!--<h2 class="title__line">Instala nuestra App</h2>-->
                        </div>
                    </div>
                </div>
                <div class="row mt--0">
                    <div class="col-lg-12 poss--relative">
                        <div class="app__download__container">
                            <div class="app__download__inner inline__image__css--1" style="background-image: url({{ asset('public/images/app/bg.png') }} );">
                                <h2>Ponemos en tus manos</h2>
                                <h6>La manera más rápida de hacer tus pedidos</h6>
                            </div>
                            <ul class="dwn__app__list">
                                <li class="wow lightSpeedIn" data-wow-delay="0.2s"><a href="#"><img src="{{ asset('public/images/app/3.png')}}" alt="app images"></a></li>
                                <!--
                                <li class="wow lightSpeedIn" data-wow-delay="0.3s"><a href="#"><img src="{{ asset('public/images/app/3.png')}}" alt="app images"></a></li>
                              -->
                              <br><br><br>
                            </ul>
                        </div>
                        <div class="app__phone wow fadeInLeft" data-wow-delay="0.2s">
                            <img src="{{ asset('public/images/app/1.png')}}" alt="app images">
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
