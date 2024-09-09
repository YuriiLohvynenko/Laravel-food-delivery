@extends('layout')
@section('content')
<div class="app-main__inner">

  <div class="app-page-title">
    <div class="page-title-wrapper">
      <div class="page-title-heading">
        <div class="page-title-icon">
          <i class="pe-7s-map-2 icon-gradient bg-mean-fruit">
          </i>
        </div>
        <div>Ubicaciones Dashboard
          <div class="page-title-subheading">Ubicación geográfica
          </div>
        </div>

      </div>
      <div class="page-title-actions">

      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="main-card mb-3 card">
        <div class="card-body">
          <div class="card-title">Mi Ubicación</div>
          <!--<div id="gmap-example"></div>-->
          <main role="main" class="container">
            <div class="row">
              <!-- Aquí pon las col-x necesarias, comienza tu contenido, etcétera -->
              <div class="col-12">
                <strong>Latitud: </strong>
                <p id="latitud"></p>
                <strong>Longitud: </strong>
                <p id="longitud"></p>
                <br>
                <a target="_blank" id="enlace" href="#">Abrir en Google Maps</a>
              </div>

              <div class="col-12" id="vermapa" style="height: 300px;"></div>
            </div>
          </main>
         
        </div>
      </div>
    </div>
  </div>
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&libraries=places&callback=initMap" async defer></script>
  <script type="text/javascript">
    const funcionInit = () => {
      if (!"geolocation" in navigator) {
        return alert("Tu navegador no soporta el acceso a la ubicación. Intenta con otro");
      }

      const $latitud = document.querySelector("#latitud"),
        $longitud = document.querySelector("#longitud"),
        $enlace = document.querySelector("#enlace");
        $vermapa = document.querySelector("#vermapa");


      const onUbicacionConcedida = ubicacion => {
        console.log("Tengo la ubicación: ", ubicacion);
        const coordenadas = ubicacion.coords;
        $latitud.innerText = coordenadas.latitude;
        $longitud.innerText = coordenadas.longitude;        
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
  <script>
    var cur_lat =0;
    var cur_lng =0;
    var des_lng =0;
    var des_lng =0;
    var des_uluru;
    var uluru;
    var map;
    var markerA,markerB;
    var iconBase ='/delivery/public/images/driver.png';
    function initMap() 
    { 
     
      navigator.geolocation.getCurrentPosition((position) => {
        console.log(position.coords.latitude, position.coords.longitude);
        cur_lat = position.coords.latitude;
        cur_lng = position.coords.longitude;
        uluru = {lat: cur_lat, lng: cur_lng};
        
        map = new google.maps.Map(
        document.getElementById('vermapa'), {zoom: 10, center: uluru});
        markerA = new google.maps.Marker({
          position: uluru,
          map: map,
          title: 'My Position',
          icon: iconBase
        });

        
       
        $.ajax({
            type: "get",
            url: "get_delivery_orders",            
            success: function(res) {
              console.log(res);
              if(res.length > 0)
              {
                for (let index = 0; index < res.length; index++) {                   
                      
                }
                des_uluru = {lat: parseFloat(res[0].latitud), lng: parseFloat(res[0].longitud)};                    
                markerB = new google.maps.Marker({
                  position: des_uluru,
                  map: map,
                  title: "Destination:" + res[0].zona + " " + res[0].urbanizacion + " " + res[0].calle + " " + res[0].casa + " " + res[0].referencia
                });

                infoWindow = new google.maps.InfoWindow;
                var directionsService = new google.maps.DirectionsService();
                var directionsRenderer1 = new google.maps.DirectionsRenderer({
                    map: map,
                    suppressMarkers: true
                });
                var directionsRenderer2 = new google.maps.DirectionsRenderer({
                    map: map,
                    suppressMarkers: true,
                    polylineOptions: {
                        strokeColor: "gray"
                    }
                });   

                directionsService.route({
                      origin: uluru,
                      destination: des_uluru,
                      travelMode: 'DRIVING',
                      provideRouteAlternatives: true
                  },
                  function(response, status) {
                      if (status === 'OK') {

                          for (var i = 0, len = response.routes.length; i < len; i++) {
                              if (i === 0) {
                                  directionsRenderer1.setDirections(response);
                                  directionsRenderer1.setRouteIndex(i);

                              } else {

                                  directionsRenderer2.setDirections(response);
                                  directionsRenderer2.setRouteIndex(i);
                              }
                          }
                          console.log(response);
                      } else {
                          window.alert('Directions request failed due to ' + status);
                      }
                  }); 
              } 
            }
          });
      });
    }
   

    function drawmap(){
      navigator.geolocation.getCurrentPosition((position) => {        
        cur_lat = position.coords.latitude;
        cur_lng = position.coords.longitude;
        var uluru = {lat: cur_lat, lng: cur_lng};
        
        
        $.ajax({
            type: "get",
            url: "set_delivery_location", 
            data: {lat: cur_lat,lng: cur_lng},           
            success: function(res) {               
                if(res.length > 0)
                {
                  for (let index = 0; index < res.length; index++) {                   
                       
                  }   
                  map = new google.maps.Map(
        document.getElementById('vermapa'), {zoom: 10, center: uluru});
                  markerA = new google.maps.Marker({
                    position: uluru,
                    map: map,
                    title: 'My Position',
                    icon: iconBase
                  });               
                  console.log(res[0].id);                
                    markerB = new google.maps.Marker({
                      position: des_uluru,
                      map: map,
                      title: "Destination:" + res[0].zona + " " + res[0].urbanizacion + " " + res[0].calle + " " + res[0].casa + " " + res[0].referencia
                    });         
                }
                
              infoWindow = new google.maps.InfoWindow;
              var directionsService = new google.maps.DirectionsService();
              var directionsRenderer1 = new google.maps.DirectionsRenderer({
                  map: map,
                  suppressMarkers: true
              });
              var directionsRenderer2 = new google.maps.DirectionsRenderer({
                  map: map,
                  suppressMarkers: true,
                  polylineOptions: {
                      strokeColor: "gray"
                  }
              });   

              directionsService.route({
                    origin: uluru,
                    destination: des_uluru,
                    travelMode: 'DRIVING',
                    provideRouteAlternatives: true
                },
                function(response, status) {
                    if (status === 'OK') {

                        for (var i = 0, len = response.routes.length; i < len; i++) {
                            if (i === 0) {
                                directionsRenderer1.setDirections(response);
                                directionsRenderer1.setRouteIndex(i);

                            } else {

                                directionsRenderer2.setDirections(response);
                                directionsRenderer2.setRouteIndex(i);
                            }
                        }
                        console.log(response);
                    } else {
                        window.alert('Directions request failed due to ' + status);
                    }
                });     
            }

          });
      }); 
    }

    $(document).ready(function(){
      setInterval(function(){       
        drawmap();
      },20000);
    });
  </script>
  <script>
    
  </script>
  
  @endsection