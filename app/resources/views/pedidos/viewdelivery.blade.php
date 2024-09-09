@extends('layout')

@section('content')
<style>
    .mb-30{margin-bottom: 30px;}
</style>
<section class="bg--white mb-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="section__title service__align--center bg-danger">
                    <h1 style="color:white;">PEDIDOS EN CURSO</h1>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div id="map" style="height: 400px;width:100%;"></div>
            </div>            
        </div>
        
    </div>
</section>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_API_KEY') }}&libraries=places&callback=initMap" async defer></script>

<script>
    var cur_lat =<?php echo $cur_pos[0]->cur_lat?>;
    var cur_lng =<?php echo $cur_pos[0]->cur_lng?>;
    var del_lat =<?php echo $cur_order->latitud?>;
    var del_lng =<?php echo $cur_order->longitud?>;
    var iconBase ='/app/public/images/driver.png';
    function initMap() 
    { 
        var uluru = {lat: parseFloat(cur_lat), lng: parseFloat(cur_lng)};
        map = new google.maps.Map(
        document.getElementById('map'), {zoom: 15, center: uluru});
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          title: 'Delivery Position',
          icon: iconBase
        });    
        des_uluru = {lat: parseFloat(del_lat), lng: parseFloat(del_lng)};
        var marker = new google.maps.Marker({
          position: des_uluru,
          map: map,
          title: 'My Position'
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
    
    $(document).ready(function(){
        var url = window.location.href; 
        var temp = url.split('/');
        var id = temp[temp.length - 1];    
        var des_uluru;   
      setInterval(function(){  
        $.ajax({
            type: "get",
            url: "/app/getdelivery", 
            data: {id:id},           
            success: function(res) {   
                console.log(res[0].cur_lat);
                if(res.length > 0)
                {                          
                    var uluru = {lat: parseFloat(res[0].cur_lat), lng: parseFloat(res[0].cur_lng)};
                    map = new google.maps.Map(
                    document.getElementById('map'), {zoom: 15, center: uluru});
                    var marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                        title: 'Delivery Position',
                        icon: iconBase
                    });
                    des_uluru = {lat: parseFloat(del_lat), lng: parseFloat(del_lng)};
                    var marker = new google.maps.Marker({
                    position: des_uluru,
                    map: map,
                    title: 'My Position'
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
      },20000);
    });
  </script>
  <script>
   
  </script>

@endsection
