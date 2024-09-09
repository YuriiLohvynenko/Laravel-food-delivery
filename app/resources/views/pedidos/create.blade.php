@extends('layout2')
@section('content')
<form action="{{ route('pedidos.store') }}" method="POST">
  {{ csrf_field() }}
  <section class="htc__checkout bg--white section-padding--lg">
    <!-- Checkout Section Start-->
    <div class="checkout-section">
      <div class="container">
        <div class="container">
          <!-- Payment Method -->
          <div>
            <div class="bg-dark">
              <h2 style="color:white;">1. Método de Pago</h2>
            </div>

            <div class="radio">
              <label><input type="radio" name="metodo" id="rbs" value="{{$metodos[0]->bs}}"
                  onclick="checkRadio(id,value)" required>Bs. </label>
            </div>
            <div class="radio">
              <label><input type="radio" name="metodo" id="refectivousd" value="{{$metodos[0]->usd}}"
                  onclick="checkRadio(id,value)">Efectivo USD$</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="metodo" id="rzelle" value="{{$metodos[0]->zelle}}"
                  onclick="checkRadio(id,value)">Zelle</label>

            </div>
            <div class="radio">
              <label><input type="radio" name="metodo" id="rotro" value="{{$metodos[0]->otro}}"
                  onclick="checkRadio(id,value)">Otros</label>

            </div>
            <div class="card">
              <div class="card-body" id="instrucciones">

              </div>
            </div>
          </div>

          <!-- end payment -->
        </div>
        <hr>
        <div class="row">


          <div class="col-lg-6 col-12 mb-30">

            <!-- Checkout Accordion Start -->
            <div id="checkout-accordion">
              <!-- Payment Method -->

              <!-- end payment -->

              <!-- Shipping Method -->
              <div class="single-accordion">
                <a class="accordion-head collapsed show" data-toggle="collapse" data-parent="#checkout-accordion"
                  href="#shipping-method">2. Indica tu dirección de entrega</a>
                <div id="shipping-method" class="collapse show">
                  <div class="accordion-body shipping-method fix">
                    <!--Carousel Wrapper-->
                    <div id="carousel-example-1z" class="carousel slide carousel-fade z-depth-1-half"
                      data-ride="carousel">
                      <!--Indicators-->
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-1z" data-slide-to="1"></li>

                      </ol>
                      <!--/.Indicators-->
                      <!--Slides-->
                      <div class="carousel-inner" role="listbox">
                        <!--First slide-->
                        <div class="carousel-item active">
                          <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                            <img class="d-block w-100" src="{{asset('public/images/cart/zonas.jpg')}}"
                              alt="Puerto Ordaz">
                          </button>
                        </div>
                        <!--/First slide-->
                        <!--Second slide-->
                        <div class="carousel-item">
                          <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                            <img class="d-block w-100" src="{{asset('public/images/cart/zonas1.jpg')}}" alt="San Félix">
                          </button>
                        </div>
                        <!--/Second slide-->

                      </div>
                      <!--/.Slides-->
                      <!--Controls-->
                      <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon bg-danger" aria-hidden="true"></span>
                        <span class="sr-only">PZO</span>
                      </a>
                      <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                        <span class="carousel-control-next-icon bg-danger" aria-hidden="true"></span>
                        <span class="sr-only">SAN FÉLIX</span>
                      </a>
                      <!--/.Controls-->
                    </div>
                    <!--/.Carousel Wrapper-->
                    <!--
                                              <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                                              <img src="{{asset('public/images/cart/zonas.jpg')}}" width="100%">
                                            </button>

                                          -->
                    <table class="table table-bordered" width="100%">
                      <tr>
                        <th style="color:black;">
                          Zona:
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                            <i class="zmdi zmdi-pin-drop"></i>
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Zonas de Delivery</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <table class="table">
                                    <tr>
                                      <th>Zona</th>
                                      <th>Detalle</th>
                                    </tr>

                                    @foreach($zonas as $row)
                                    <tr>
                                      <td>{{$row->nombre}}</td>
                                      <td>{{$row->descripcion}}</td>
                                    </tr>
                                    @endforeach

                                  </table>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </th>
                        <th>
                          <select class="btn btn-warning" name="zona" id="zona" onchange="delivery()" required>
                            <option value="">Seleccione su Zona</option>
                            <option value="0">RETIRO EN TIENDA</option>
                            @foreach($zonas as $row)
                            <option value="{{$row->precio}}">{{$row->nombre}}</option>
                            @endforeach
                          </select>
                          <input type="hidden" name="nombrezona" id="nombrezona">
                        </th>
                      </tr>
                      <tr style="color:black;">
                        <td>Urbanización</td>
                        <td><input type="text" id="urbanizacion" name="urbanizacion" value="" required></td>
                      </tr>
                      <tr style="color:black;">
                        <td>Calle</td>
                        <td> <input type="text" id="calle" name="calle" value="" required> </td>
                      </tr>
                      <tr style="color:black;">
                        <td> Casa / Apto. </td>
                        <td> <input type="text" id="casa" name="casa" value="" required> </td>
                      </tr>
                      <tr style="color:black;">
                        <td>Punto de Referencia</td>
                        <td> <input type="text" id="referencia" name="referencia" value="" required> </td>
                      </tr>
                    </table>
                    <!-- ubicacion actual -->
                    <div class="row">
                      <div class="col-md-12">
                        <div class="main-card mb-3 card">
                          <div class="card-body">
                            <div class="card-title">Tu Ubicación actual</div>
                            <!--<div id="gmap-example"></div>-->
                            <main role="main" class="container">
                              <div class="row">
                                <!-- Aquí pon las col-x necesarias, comienza tu contenido, etcétera -->

                                <div class="col-12">
                                  <!--<strong>Latitud: </strong>-->
                                  <p id="latitud" style="visibility:hidden"></p>
                                  <!--<strong>Longitud: </strong>-->
                                  <p id="longitud" style="visibility:hidden"></p>
                                  <input type="hidden" name="lat" id="lat">
                                  <input type="hidden" name="lon" id="lon">
                                  <br>
                                  <a target="_blank" id="enlace" href="#"></a>
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
                                  document.getElementById('lat').value = coordenadas.latitude;
                                  document.getElementById('lon').value = coordenadas.longitude;
                                  $enlace.href = `https://www.google.com/maps/@${coordenadas.latitude},${coordenadas.longitude},20z`;
                                  $vermapa.innerHTML = `<iframe width="100%"src="https://maps.google.com/maps?q=${coordenadas.latitude},${coordenadas.longitude}&output=embed"></iframe>`;
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
                  </div>

                </div>
              </div>
              <!-- end Shipping -->



            </div><!-- Checkout Accordion Start -->
          </div>

          <!-- Order Details -->
          <div class="col-lg-6 col-12 mb-30">

            <div class="order-details-wrapper">
              <h2>Detalles de Tu pedido</h2>
              <div class="order-details">

                <ul>
                  <li>
                    <p class="strong">Menú</p>
                    <p class="strong">total</p>
                  </li>
                  @php $moneda=""; $TOTALcomplementos=0; @endphp
                  @if(isset($carritos))
                  @foreach($carritos as $row)
                  @php $moneda=$row->moneda; $negocio=$row->negocio; @endphp
                  <li>
                    <p>
                      <font color="black">{{$row->nombre}}</font><br> {{$row->moneda}} {{number_format($row->precio,2)}}
                      x {{$row->cantidad}}
                    </p>
                    <p>{{$row->moneda}} {{number_format($row->precio*$row->cantidad,2)}}</p>
                  </li>
                  @if(isset($complementos))
                  @php $totalcomplementos=0; @endphp
                  @foreach($complementos as $complemento)
                  @if($complemento->carrito==$row->id)
                  <li>
                    <p>
                      <font>{{$complemento->nombre}}</font><br> {{$complemento->moneda}}
                      {{number_format($complemento->precio,2)}} x {{$row->cantidad}}
                    </p>
                    <p>{{$complemento->moneda}} {{number_format($complemento->precio*$row->cantidad,2)}}</p>
                  </li>
                  @php $totalcomplementos=$totalcomplementos+$complemento->precio; @endphp
                  @endif
                  @endforeach
                  @endif
                  @php
                  $subtotal=($row->precio+$totalcomplementos)*$row->cantidad;
                  $TOTALcomplementos=$TOTALcomplementos+$subtotal;
                  @endphp
                  @endforeach
                  @endif
                  <input type="hidden" name="negocio" value="{{$negocio}}">
                  <input type="hidden" name="moneda" value="{{$moneda}}">
                  <li>
                    <p class="strong">Subtotal</p>
                    <p class="strong">
                      {{$moneda}} {{number_format($TOTALcomplementos,2)}}
                      <input type="hidden" name="subtotal" value="{{$TOTALcomplementos}}" id="subtotal" required
                        onkeypress="return false;">
                    </p>
                  </li>
                  <li>
                    <p class="strong">Costo Delivery</p>
                    <p>
                      <input type="text" name="costodelivery" id="costodelivery" value="" required
                        onkeypress="return false;" placeholder="Seleccionar la Zona" readonly>
                    </p>
                  </li>
                  <li>
                    <p class="strong">Total a pagar (USD$)</p>
                    <p class="strong">
                      <label id="labeltotal" style="color:red;font-weight: bold;"></label>
                      <input type="hidden" name="total" value="" id="total" readonly>
                    </p>
                  </li>
                  <li>
                    <p class="strong">Tasa de Cambio del negocio</p>
                    <p class="strong">
                      <label id="labeltasa"
                        style="font-weight: bold;">{{number_format($datosnegocio[0]->tasadecambio,2)}}</label>
                      <input type="hidden" name="tasadecambio" value="{{$datosnegocio[0]->tasadecambio}}" id="tasa"
                        readonly>
                    </p>
                  </li>
                  <li>
                    <p class="strong">Total a pagar (Bs.)</p>
                    <p class="strong">
                      <label id="labeltotalbs" style="color:red;font-weight: bold;"></label>
                      <input type="hidden" name="totalbs" value="" id="totalbs" readonly>
                    </p>
                  </li>
                  <!--
                                                <li>
                                                  <p class="strong">Comprobante de pago</p>
                                                  <p class="strong">
                                                    <input class="btm btn-info" type="file" name="archivofoto" class="form-control" required>
                                                  </p>
                                                </li>
                                              -->
                  <li>
                    <p class="strong">Instrucciones o comentarios</p>
                    <p class="strong">
                      <textarea id="instrucciones" name="instrucciones" rows="3" width="100%"></textarea>
                      <!--
                                                    <input type="text" id="fname" onfocusout="myFunction()">
                                                    <script type="text/javascript">
                                                            function myFunction() {
                                                            var x = document.getElementById("fname");
                                                            x.value = x.value.toUpperCase();
                                                            }
                                                    </script>
                                                  -->
                      <input id="token" type="hidden" name="token" value="" readonly>
                    </p>
                  </li>
                  <li>
                    <p class="strong">
                      <button class="btn btn-success">Ordenar</button>
                    </p>
                  </li>
                </ul>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div><!-- Checkout Section End-->
  </section>
</form>
<p align="center"><a href="{{env('APP_URL')}}/carrito">
    <button class="btn btn-warning">Regresar al carrito</button>
  </a></p><br>

<script type="text/javascript">
  function checkRadio(id, value) {
    instrucciones = document.getElementById("instrucciones");
    instrucciones.innerHTML = '<pre>' + value + '</pre>';

  }

  function delivery() {
    var e = document.getElementById("zona");
    var st = document.getElementById("subtotal");
    var t = document.getElementById("total");
    var lt = document.getElementById("labeltotal");
    var ltasa = document.getElementById("labeltasa");

    var tbs = document.getElementById("totalbs");
    var ltbs = document.getElementById("labeltotalbs");
    var tasa = document.getElementById("tasa");

    var costodelivery = document.getElementById("costodelivery");
    var nombrezona = document.getElementById("nombrezona");

    costodelivery.value = e.options[e.selectedIndex].value;
    nombrezona.value = e.options[e.selectedIndex].text;

    t.value = parseFloat(costodelivery.value) + parseFloat(st.value);

    lt.innerHTML = new Intl.NumberFormat().format(t.value);

    ltasa.innerHTML = new Intl.NumberFormat().format(tasa.value);


    tbs.value = parseFloat(t.value) * parseFloat(tasa.value);
    ltbs.innerHTML = new Intl.NumberFormat().format(tbs.value);

    if (nombrezona.value == 'RETIRO EN TIENDA') {
      document.getElementById("urbanizacion").value = "RETIRO EN TIENDA";
      document.getElementById("urbanizacion").readOnly = true;

      document.getElementById("calle").value = "RETIRO EN TIENDA";
      document.getElementById("calle").readOnly = true;

      document.getElementById("casa").value = "RETIRO EN TIENDA";
      document.getElementById("casa").readOnly = true;

      document.getElementById("referencia").value = "RETIRO EN TIENDA";
      document.getElementById("referencia").readOnly = true;

    }
    else {
      document.getElementById("urbanizacion").value = "";
      document.getElementById("urbanizacion").readOnly = false;

      document.getElementById("calle").value = "";
      document.getElementById("calle").readOnly = false;

      document.getElementById("casa").value = "";
      document.getElementById("casa").readOnly = false;

      document.getElementById("referencia").value = "";
      document.getElementById("referencia").readOnly = false;
    }

  }
</script>


<!-- token -->
<script type="text/javascript">
  messaging.requestPermission()
    .then(function () {
      return messaging.getToken();
    })
    .then(function (token) {
      console.log('token generated');
      console.log(token);
      console.log('token generated');
      var tk = document.getElementById("token");
      tk.value = token;
    })
    .catch(function (err) {
      console.log(err);
    })
</script>

<script>
  var token = Website2APK.getFirebaseDeviceToken();
  var tk = document.getElementById("token");
  if (tk.value == "") {
    tk.value = token;
  }
</script>


@endsection