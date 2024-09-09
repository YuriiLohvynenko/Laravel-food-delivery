@extends('layout')
@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoJ564UPvTdf7bNQ8ZA4mPo6LNmLOqBEE"></script>
<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);

    // Multiple markers location, latitude, and longitude
    var markers = [
        <?php
            $i=4;
            if(1){
              $nombre="Prueba";
              $latitud="19.322881";
              $longitud="-99.133884";
              $icon="https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
            while($i){
                echo '["'.$nombre.'", '.$latitud.', '.$longitud.', "'.$icon.'"],';
                $i--;
            }
        }
        ?>
    ];

    // Info window content
    var infoWindowContent = [
        <?php
          $i=4;
          if(1){
            $name="Prueba Name";
            $info="Prueba Info";
            while($i){ ?>
                ['<div class="info_content">' +
                '<h3><?php echo $name; ?></h3>' +
                '<p><?php echo $info; ?></p>' + '</div>'],
        <?php
            $i--;
            }
        }
        ?>
    ];

    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Place each marker on the map
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: markers[i][3],
            title: markers[i][0]
        });

        // Add info window to marker
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
}

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>

<div id="mapCanvas"></div>



<div class="app-main__inner">

                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-map-2 icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Ubicaciones Dashboard
                                        <div class="page-title-subheading">Ubicación geográfica de los comercios afiliados
                                        </div>
                                    </div>

                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block dropdown">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-business-time fa-w-20"></i>
                                            </span>
                                            Buttons
                                        </button>
                                    </div>
                                    </div>
                                </div>
                        </div>
<div class="row">
  <div class="col-md-12">
    <div class="main-card mb-3 card">
      <div class="card-body">
          <div class="card-title">Google Maps</div>
          <!--<div id="gmap-example"></div>-->
      </div>
    </div>
  </div>
</div>

@endsection
