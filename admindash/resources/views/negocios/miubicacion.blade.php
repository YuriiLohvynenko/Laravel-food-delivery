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
                                        <div class="page-title-subheading">Tu Ubicación actual
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
				<strong>Latitud: </strong> <p id="latitud"></p>
				<strong>Longitud: </strong> <p id="longitud"></p>
				<br>
				<a target="_blank" id="enlace" href="#">Abrir en Google Maps</a>
			</div>

      <div class="col-12" id="vermapa"></div>
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
  $vermapa = document.querySelector("#vermapa");


const onUbicacionConcedida = ubicacion => {
  console.log("Tengo la ubicación: ", ubicacion);
  const coordenadas = ubicacion.coords;
  $latitud.innerText = coordenadas.latitude;
  $longitud.innerText = coordenadas.longitude;
  $enlace.href = `https://www.google.com/maps/@${coordenadas.latitude},${coordenadas.longitude},20z`;
  $vermapa.innerHTML=`<iframe width="100%"src="https://maps.google.com/maps?q=${coordenadas.latitude},${coordenadas.longitude}&output=embed"></iframe>`;
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

@endsection
