@extends('layout')
@section('content')
<!-- HEADER ESTATUS -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="section__title service__align--center bg-danger">
            <h1 style="color:white;">PEDIDO NRO. {{$pedido->id}}</h1>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 bg-warning">
        <div class="section__title service__align--center">
          @switch($pedido->estatus)
            @case("PENDIENTE")
            <h2 style="color:black">{{$pedido->estatus}}
            <i class="zmdi zmdi-spinner zmdi-hc-spin zmdi-hc-x"></i>
            </h2>
              </label>
              <div class="alert alert-dark" role="alert">
                <b>En espera de aceptación del pedido</b>
              </div>
             @break
             @case("ACEPTADO")
               <label class="bg-warning"><strong>Estatus: {{$pedido->estatus}}</strong>
                 <i class="zmdi zmdi-spinner zmdi-hc-spin"></i>
               </label>
               <div class="alert alert-dark" role="alert">
                 <b>Por favor proceder a realizar el pago</b>
               </div>
               <a class="btn btn-success" href="{{env('APP_URL')}}/pedido/{{$pedido->id}}/pagar">
                 Registrar comprobante pago
               </a>
              @break
              @case("APROBADO")
              <h2 style="color:black">{{$pedido->estatus}}
              <i class="zmdi zmdi-spinner zmdi-hc-spin zmdi-hc-x"></i>
              </h2>
                </label>
                <div class="alert alert-primary" role="alert">
                  Ya tu pedido esta preparándose
                </div>
               @break
               @case("CANCELADO")
               <h2 style="color:black">{{$pedido->estatus}}
               </h2>
                 </label>
                 <div class="alert alert-secondary" role="alert">
                   El pedido fue cancelado
                 </div>
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
          <h2 style="color:black">DATOS DEL CLIENTE</h2>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-white">
                    <th><img src="/app/public/storage/app/public/uploads/{{ $user->foto }}" alt="" class="img-circle img-responsive" width="100"></th>
                    <th>
                      {{$user->name}}<br>
                      @for($i=0;$i<$ratingcli;$i++)
                        <i class="zmdi zmdi-star" style="color:#ffe700"></i>
                      @endfor
                      @for($j=$i;$j<5;$j++)
                        <i class="zmdi zmdi-star"></i>
                      @endfor
                      <i class="zmdi zmdi-thumb-up" style="color:red;">{{$compras[0]->num}}</i>
                    </th>
                </tr>
                <tr class="bg-white">
                    <th>Cédula:</th>
                    <th>{{$user->cedula}}</th>
                </tr>
                <tr class="bg-white">
                    <th>Teléfono:</th>
                    <th>{{$user->telefono}}</th>
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
          <h2 style="color:black">DATOS DEL NEGOCIO</h2>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-white">
                    <th>
                      <img src="/deliverydash/public/storage/app/public/uploads/{{$negocio->logo}}" width="35px" alt="Logo del Negocio">
                    </th>
                    <th>
                      <b><font color="black">{{$negocio->nombre}}</font></b><br>
                      @for($i=0;$i<$rating;$i++)
                        <i class="zmdi zmdi-star" style="color:#ffe700"></i>
                      @endfor
                      @for($j=$i;$j<5;$j++)
                        <i class="zmdi zmdi-star"></i>
                      @endfor
                      <i class="zmdi zmdi-thumb-up" style="color:red;">{{$ventas[0]->num}}</i>
                    </th>
                </tr>
                <tr class="bg-white">
                    <th>Teléfono:</th>
                    <th>
                      <a href="tel:{{$negocio->telefono}}">{{$negocio->telefono}}</a>
                    </th>
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
        <h2 style="color:black">DIRECCIÓN DE ENTREGA</h2>
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
<!--
    <iframe width="100%" height="500" src="https://maps.google.com/maps?q={{$pedido->latitud}},{{$pedido->longitud}}&output=embed"></iframe>
-->

    <iframe width="100%" height="500" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/directions?origin={{$negocio->latitud}}%2C{{$negocio->longitud}}&destination={{$pedido->latitud}}%2C{{$pedido->longitud}}&key=AIzaSyDx2Nw4Wn9Dm0BHx89c1fo6iH7_ytUL5Gk" allowfullscreen></iframe>

<!--
    <a class="btn btn-success" target="_blank" id="enlace" href="https://www.google.com/maps/dir/?api=1&origin={{$negocio->latitud}},{{$negocio->longitud}}&destination={{$pedido->latitud}},{{$pedido->longitud}}&travelmode=driving.">
      VER RUTA HACIA EL DESTINO
    </a>
-->    
  </div>
  <!-- DATOS DEL PEDIDO -->
  <div class="col-md-6 col-lg-6 bg-light">
    <div class="section__title service__align--center">
        <h2 style="color:black">DETALLE DEL PEDIDO</h2>
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
      <form class="" action="{{env('APP_URL')}}/vercomprobante" method="post">
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


@endsection
