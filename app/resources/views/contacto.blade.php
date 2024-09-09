@extends('layout')

@section('content')
<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--19">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center brad__white">
                                <h2 class="bradcaump-title">Contacto</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="{{env('APP_URL')}}">Inicio</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                  <span class="breadcrumb-item active">Contacto</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- map area -->
        <div class="">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252679.45065202465!2d-62.84959605036141!3d8.291211852034452!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8dcbf02b84200b49%3A0x6e05317f7c974d14!2sCiudad%20Guayana%2C%20Bol%C3%ADvar%2C%20Venezuela!5e0!3m2!1ses!2smx!4v1588807702525!5m2!1ses!2smx" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
        <!-- fin map -->
        <!-- Start Address -->
        <div class="food__contact">
            <div class="food__contact__wrapper d-flex flex-wrap flex-lg-nowrap">
                <!-- Start Single Contact -->
                <div class="contact">
                    <div class="ct__icon">
                        <i class="zmdi zmdi-phone"></i>
                    </div>
                    <div class="ct__address">
                        <p><a href="#">+088 01673-453290</a></p>
                        <p><a href="#">+088 01773-458290</a></p>
                    </div>
                </div>
                <!-- End Single Contact -->
                <!-- Start Single Contact -->
                <div class="contact">
                    <div class="ct__icon">
                        <i class="zmdi zmdi-home"></i>
                    </div>
                    <div class="ct__address">
                        <p>Alta Vista <br> Puerto Ordaz, Venezuela</p>
                    </div>
                </div>
                <!-- End Single Contact -->
                <!-- Start Single Contact -->
                <div class="contact">
                    <div class="ct__icon">
                        <i class="zmdi zmdi-email"></i>
                    </div>
                    <div class="ct__address">
                        <p><a href="#">info@pideme.com</a></p>
                    </div>
                </div>
                <!-- End Single Contact -->
            </div>
        </div>
        <!-- End Address -->

@endsection
