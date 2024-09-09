@extends('layout')

@section('content')
<!-- Start Bradcaump area -->
<div class="section__title service__align--center bg-danger">
    <!--<p>the process of our service</p>-->
    <h1 style="color:white;">UBICACIÓN</h1>
</div>
<!--
        <div class="ht__bradcaump__area bg-image--19">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center brad__white">
                                <h2 class="bradcaump-title">Ubicación</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="{{env('APP_URL')}}">Inicio</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                  <span class="breadcrumb-item active">Ubicación</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      -->
        <!-- End Bradcaump area -->
        <!-- Start About Us Area  -->
        <section class="food__about__us__area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title title__style--2 service__align--center">
                            <h2 class="title__line">{{$negocio[0]->nombre}}</h2>
                            <p><img src="/deliverydash/public/storage/app/public/uploads/{{$negocio[0]->logo}}" width="150" alt="Foto del Negocio"></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                  @if($negocio[0]->estatus)
                    <a class="food__btn grey--btn theme--hover" href="{{env('APP_URL')}}/menu/{{$negocio[0]->id}}">VER MENÚ</a>
                  @else
                    <button type="button" class="btn btn-danger xs">CERRADO</button>
                  @endif
                </div>
                <div class="row p-2">
                    <div class="col-lg-6 col-sm-12 col-md-12 align-self-center">

                        <div class="food__container">
                            <div class="food__inner">
                                <h2 style="color:red">Dirección</h2>
                                <p>{{$negocio[0]->direccion}}</p>
                                <br>
                                <hr>
                                <h2 style="color:red">Horarios</h2>
                                <ul>
                                  <li>Lunes: {{$negocio[0]->lunesa}} - {{$negocio[0]->lunesc}}</li>
                                  <li>Martes: {{$negocio[0]->martesa}} - {{$negocio[0]->martesc}}</li>
                                  <li>Miércoles: {{$negocio[0]->miercolesa}} - {{$negocio[0]->miercolesc}}</li>
                                  <li>Jueves: {{$negocio[0]->juevesa}} - {{$negocio[0]->juevesc}}</li>
                                  <li>Viernes: {{$negocio[0]->viernesa}} - {{$negocio[0]->viernesc}}</li>
                                  <li>Sábado: {{$negocio[0]->sabadoa}} - {{$negocio[0]->sabadoc}}</li>
                                  <li>Domingo: {{$negocio[0]->domingoa}} - {{$negocio[0]->domingoc}}</li>
                                </ul>

                            </div>

                            <!--
                            <div class="food__details">
                                <p>
                                  <iframe width="100%" height="500" src="https://maps.google.com/maps?q={{str_replace(" ", "+", $negocio[0]->direccion)}}&output=embed"></iframe>
                                </p>
                            </div>
                          -->
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-md-12">
                      <input type="hidden" id="latdestino" value="{{$negocio[0]->latitud}}">
                      <input type="hidden" id="londestino" value="{{$negocio[0]->longitud}}">
                      <a class="btn btn-success" target="_blank" id="enlace" href="#">
                        VER RUTA HACIA EL DESTINO
                      </a>
                        <div class="food__video__wrap tab-content" id="nav-tabContent">
                            <!-- Start Single Video -->
                            <div class="video__owl__activation tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="about__video__activation owl-carousel owl-theme">
                                    <div class="about__video__inner">
                                        <div>
                                            <!--<iframe width="100%" height="500" src="https://maps.google.com/maps?q={{str_replace(" ", "+", $negocio[0]->direccion)}}&output=embed"></iframe>-->
                                            <iframe width="100%" height="500" src="https://maps.google.com/maps?q={{$negocio[0]->latitud}},{{$negocio[0]->longitud}}&output=embed"></iframe>

                                        </div>
                                    </div>
                                    <div class="about__video__inner">
                                        <div class="about__video__thumb">
                                            <!--<iframe width="100%" height="500" src="https://maps.google.com/maps?q={{$negocio[0]->latitud}},{{$negocio[0]->longitud}}&output=embed"></iframe>-->
                                            <!--<iframe width="100%" height="500" src="https://maps.google.com/maps?q={{str_replace(" ", "+", $negocio[0]->direccion)}}&output=embed"></iframe>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Video -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Us Area  -->


        <!-- ubicacion actual -->
        <div class="row">
          <div class="col-md-12">
            <div class="main-card mb-3 card">
              <div class="card-body">

                  <!--<div id="gmap-example"></div>-->
                  <main role="main" class="container">
            <div class="row">
              <!-- Aquí pon las col-x necesarias, comienza tu contenido, etcétera -->

              <div class="col-12">
                <!--<strong>Latitud: </strong>--> <p id="latitud" style="visibility:hidden"></p>
                <!--<strong>Longitud: </strong>--> <p id="longitud" style="visibility:hidden"></p>
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lon" id="lon">
                <br>
              </div>
            </div>
          </main>
          <script type="text/javascript">
          const funcionInit = () => {
        if (!"geolocation" in navigator) {
          return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
        }

        const $latitud = document.querySelector("#latitud"),
          $longitud = document.querySelector("#longitud"),
          $enlace = document.querySelector("#enlace");

        const onUbicacionConcedida = ubicacion => {
          console.log("Tengo la ubicación: ", ubicacion);
          const coordenadas = ubicacion.coords;
          $latitud.innerText = coordenadas.latitude;
          $longitud.innerText = coordenadas.longitude;
          document.getElementById('lat').value=coordenadas.latitude;
          document.getElementById('lon').value=coordenadas.longitude;
          var latdestino = document.getElementById('latdestino').value
          var londestino = document.getElementById('londestino').value
          $enlace.href = `https://www.google.com/maps/dir/?api=1&origin=${coordenadas.latitude},${coordenadas.longitude}&destination=${latdestino},${londestino}&travelmode=driving.`;
        }
        const onErrorDeUbicacion = err => {

          $latitud.innerText = "Error obteniendo ubicación: " + err.message;
          $longitud.innerText = "Error obteniendo ubicación: " + err.message;
          console.log("Error obteniendo ubicación: ", err);
        }

        const opcionesDeSolicitud = {
          enableHighAccuracy: true, // Alta precisión
          maximumAge: 0, // No queremos caché
          timeout: 5000 // Esperar solo 5 segundos
        };

        $latitud.innerText = "Cargando...";
        $longitud.innerText = "Cargando...";
        navigator.geolocation.getCurrentPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);

        };
        document.addEventListener("DOMContentLoaded", funcionInit);

          </script>
              </div>
            </div>
          </div>
        </div>
        <!-- fun ubicacion actual -->


@endsection
