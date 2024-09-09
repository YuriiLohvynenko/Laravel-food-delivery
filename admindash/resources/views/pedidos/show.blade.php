@extends('layout')
@section('content')

<div class="app-main__inner">

                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-cart icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Pedidos Dashboard
                                        <div class="page-title-subheading">Listado de pedidos
                                        </div>
                                    </div>

                                </div>
                                <div class="page-title-actions">

                                </div>
                            </div>
                        </div>

<!-- HEADER ESTATUS -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="section__title service__align--center bg-danger">
            <h1 align="center" style="color:white;">PEDIDO NRO. {{$pedido->id}}</h1>
        </div>
    </div>

    <div class="col-md-12 col-lg-12 bg-light">
        <div>
            @switch($pedido->estatus)
              @case("PENDIENTE")
                <h2 align="center" style="color:black">{{$pedido->estatus}}
                  <i class="fas fa-spinner fa-spin"></i>
                </h2>
                <p align="center">
                  <form action="{{env('APP_URL')}}/pedidos/update/{{$pedido->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="estatus" value="ACEPTADO">
                    <button type="submit" class="btn btn-success"><b>ACEPTAR PEDIDO</b></button>
                  </form>
                  <br>
                  <form action="{{env('APP_URL')}}/pedidos/update/{{$pedido->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="estatus" value="CANCELADO">
                    <button type="submit" class="btn btn-warning"><b>CANCELAR PEDIDO</b></button>
                    <input type="text" name="instrucciones" value="" placeholder="Indique motivo" required>
                  </form>
                </p>
              @break
              @case("PAGADO")
                <h2 align="center" style="color:black">{{$pedido->estatus}}
                  <i class="fas fa-spinner fa-spin"></i>
                </h2>
                <p align="center">
                  <form class="" action="{{env('APP_URL')}}/comprobante" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$pedido->id}}">
                    <button type="submit" class="btn btn-primary">Ver Comprobante</button>
                  </form>
                </p>
              @break
              @case("APROBADO")
                <h2 align="center" style="color:black">{{$pedido->estatus}}
                  <i class="fas fa-spinner fa-spin"></i>
                </h2>
                <p align="center">
                  <!--
                  <form action="{{ route('pedidos.update',$pedido->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="estatus" value="DESPACHADO">
                    <button type="submit" class="btn btn-primary">Indicar que fue entregado al Delivery</button>
                  </form>
                -->
                </p>
              @break
              @case("DESPACHADO")
                <h2 align="center" style="color:black">{{$pedido->estatus}}
                </h2>
              @break
              @case("CANCELADO")
                <h2 align="center" style="color:gray">{{$pedido->estatus}}
                </h2>
              @break
            @endswitch

            <form class="" action="{{env('APP_URL')}}/iniciarchat" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$pedido->id}}">
              <button type="submit" class="btn btn-primary">
                <i class="zmdi zmdi-comments"></i> Mensajes
              </button>
              <a class="btn btn-info" href="{{env('APP_URL')}}/pedidos">
                Regresar
              </a>
            </form>
        </div>
    </div>
</div>

<!-- DATOS CLIENTES / NEGOCIO -->
<div class="row">
  <div class="col-md-6 col-lg-6 bg-light">
      <div class="section__title service__align--center">
          <h2 style="color:black">Datos de Cliente</h2>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-white">
                    <th><img src="/app/public/storage/app/public/uploads/{{ $user->foto }}" alt="" class="img-circle img-responsive" width="100"></th>
                    <th>
                      {{$user->name}}<br>
                      @for($i=0;$i<$ratingcli;$i++)
                        <i class="fa fa-star" style="color:#ffe700"></i>
                      @endfor
                      @for($j=$i;$j<5;$j++)
                        <i class="fa fa-star"></i>
                      @endfor
                      <i class="fa fa-thumbs-up" style="color:red;">{{$compras[0]->num}}</i>
                    </th>
                </tr>
                <tr class="bg-white">
                    <th>Cédula:</th>
                    <th><a>{{$user->cedula}}</a></th>
                </tr>
                <tr class="bg-white">
                    <th>Teléfono:</th>
                    <th><a href="tel:{{$user->telefono}}">{{$user->telefono}}</a></th>
                </tr>
                <tr class="bg-white">
                    <th>Email:</th>
                    <th>{{$user->email}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

      </div>
  </div>
  <div class="col-md-6 col-lg-6 bg-light">
      <div class="section__title service__align--center">
          <h2 style="color:black">Datos del Negocio</h2>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-white">
                    <th>
                      <img src="/deliverydash/public/storage/app/public/uploads/{{$negocio->logo}}" width="35px" alt="Logo del Negocio">
                    </th>
                    <th>
                      {{$negocio->nombre}}<br>
                      @for($i=0;$i<$rating;$i++)
                        <i class="fa fa-star" style="color:#ffe700"></i>
                      @endfor
                      @for($j=$i;$j<5;$j++)
                        <i class="fa fa-star"></i>
                      @endfor
                      <i class="fa fa-thumbs-up" style="color:red;">{{$ventas[0]->num}}</i>
                    </th>
                </tr>
                <tr class="bg-white">
                    <th>Teléfono:</th>
                    <th><a href="tel:{{$negocio->telefono}}">{{$negocio->telefono}}</a></th>
                </tr>
                <tr class="bg-white">
                    <th>Sector:</th>
                    <th>{{$negocio->sector}}</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
  </div>
</div>


<div class="row">
  <!-- DIRECCION -->
  <div class="col-md-6 col-lg-6 bg-light">
    <div class="section__title service__align--center">
        <h2 style="color:black">Dirección de Entrega</h2>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered">
          <thead>
              <tr class="bg-white" style="color:black;">
                  <td>
                    ZONA:
                  </td>
                  <td>{{$pedido->zona}}</td>
              </tr>
              <tr class="bg-white" style="color:black;">
                <td>Urbanización</td>
                <td>{{$pedido->urbanizacion}}</td>
              </tr>
              <tr class="bg-white" style="color:black;">
                <td>Calle</td>
                <td>{{$pedido->calle}}</td>
              </tr>
              <tr class="bg-white" style="color:black;">
                <td> Casa / Apto. </td>
                <td>{{$pedido->casa}}</td>
              </tr>
              <tr class="bg-white" style="color:black;">
                <td>Punto de Referencia</td>
                <td>{{$pedido->referencia}}</td>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
    </div>
    <iframe width="100%" height="500" src="https://maps.google.com/maps?q={{$pedido->latitud}},{{$pedido->longitud}}&output=embed"></iframe>
    <input type="hidden" id="latdestino" value="{{$pedido->latitud}}">
    <input type="hidden" id="londestino" value="{{$pedido->longitud}}">
    <a class="btn btn-success" target="_blank" id="enlace" href="#">
      VER RUTA HACIA EL DESTINO
    </a>
  </div>
  <!-- DATOS DEL PEDIDO -->
  <div class="col-md-6 col-lg-6 bg-light">
    <div class="section__title service__align--center">
        <h2 style="color:black">Detalle del Pedido</h2>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered">
          <thead>
              <tr class="bg-white" style="color:black;">
                  <td>
                    SUBTOTAL:
                  </td>
                  <td>{{$pedido->moneda}} {{$pedido->subtotal}} </td>
              </tr>
              <tr class="bg-white" style="color:black;">
                <td>Costo Delivery</td>
                <td>{{$pedido->moneda}} {{$pedido->costodelivery}}</td>
              </tr>
              <tr class="bg-white" style="color:black;">
                <td><b>TOTAL</b></td>
                <td><b>{{$pedido->moneda}} {{$pedido->total}}</b></td>
              </tr>
              <tr class="bg-white" style="color:black;">
                <td> Tasa de Cambio </td>
                <td>{{number_format($pedido->tasadecambio,2)}}</td>
              </tr>
              <tr class="bg-white" style="color:black;">
                <td><b>Total en Bs.</b></td>
                <td><b>{{number_format($pedido->total*$pedido->tasadecambio,2)}}</b></td>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
    </div>
    <div class="bg-white">
      <h4 style="color:black;">MÉTODO DE PAGO</h4>
      @if($pedido->comprobante)
      <form class="" action="{{env('APP_URL')}}/comprobante" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$pedido->id}}">
        <button type="submit" class="btn btn-primary btn-sm"> Ver Comprobante</button>
      </form>
      @endif
      <pre style="color:black;">{{$pedido->metodo}}</pre>
    </div>
    <div class="bg-white">
      <h4 style="color:black;">INSTRUCCIONES O COMENTARIOS</h4>
      <pre style="color:red;  font-size: large;  font-weight: bold;">{{$pedido->instrucciones}}</pre>
    </div>
    <!-- detalle del pedido -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr class="bg-white">
          <th>Producto</th>
          <!--<th>Cant</th>-->
          <th>Total</th>
        </tr>
        @foreach($detalles as $detalle)
        <tr class="bg-white">
          <td class="product-name">
            <img src="/deliverydash/public/storage/app/public/uploads/{{$detalle->foto}}" width="50" alt="list food images"><br>
            <font color="black">{{$detalle->nombre}}</font><br>
            <h4 style="color:red">{{$pedido->moneda}} {{$detalle->precio}} ( Cant. {{$detalle->cantidad}})</h4>
            <hr>
            @php $totalcomplementos=0; @endphp
            @foreach($complementos as $complemento)
              @if($complemento->pedidodetalle==$detalle->id)
                {{$detalle->cantidad}} x <font color="black">{{$complemento->nombre}}</font> - <font color="red">{{$pedido->moneda}} {{$complemento->precio}}</font> = {{$complemento->precio*$detalle->cantidad}} {{$pedido->moneda}}<hr>
                @php $totalcomplementos=$totalcomplementos+$complemento->precio; @endphp
              @endif
            @endforeach
          </td>
          <!--<td>{{$detalle->cantidad}}</td>-->
          <td>{{$pedido->moneda}} {{($detalle->precio+$totalcomplementos)*$detalle->cantidad}}</td>
        </tr>
        @endforeach
      </table>
    </div>

  </div>
</div>

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
