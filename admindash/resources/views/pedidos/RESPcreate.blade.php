@extends('layout2')
@section('content')
<section class="htc__checkout bg--white section-padding--lg">
            <!-- Checkout Section Start-->
            <div class="checkout-section">
                <div class="container">
                    <div class="row">
                      <!-- Payment Method -->

                          <div>
                            <h2>1. Método de Pago</h2>
                            <div class="radio">
                                <label><input type="radio" name="optradio" id="rbs" value="{{$metodos[0]->bs}}" onclick="checkRadio(id,value)">Bs. </label>
                              </div>
                              <div class="radio">
                                <label><input type="radio" name="optradio" id="refectivousd" value="{{$metodos[0]->usd}}" onclick="checkRadio(id,value)">Efectivo USD$</label>
                              </div>
                              <div class="radio">
                                <label><input type="radio" name="optradio" id="rzelle" value="{{$metodos[0]->zelle}}" onclick="checkRadio(id,value)">Zelle</label>

                              </div>
                              <div class="radio">
                                <label><input type="radio" name="optradio" id="rotro" value="{{$metodos[0]->otro}}" onclick="checkRadio(id,value)">Otros</label>

                              </div>
                              <div id="instrucciones">

                              </div>
                          </div>

                      <!-- end payment -->
                    </div>
                    <div class="row">




                        <div class="col-lg-6 col-12 mb-30">

                                <!-- Checkout Accordion Start -->
                                <div id="checkout-accordion">
                                  <!-- Payment Method -->
                                  <div class="single-accordion">
                                      <a class="accordion-head collapsed show" data-toggle="collapse" data-parent="#checkout-accordion" href="#payment-method">1. Método de Pago</a>
                                      <div id="payment-method" class="collapse">

                                        <div class="radio">
                                            <label><input type="radio" name="optradio" id="rbs" value="{{$metodos[0]->bs}}" onclick="checkRadio(id,value)">Bs. </label>
                                          </div>
                                          <div class="radio">
                                            <label><input type="radio" name="optradio" id="refectivousd" value="{{$metodos[0]->usd}}" onclick="checkRadio(id,value)">Efectivo USD$</label>
                                          </div>
                                          <div class="radio">
                                            <label><input type="radio" name="optradio" id="rzelle" value="{{$metodos[0]->zelle}}" onclick="checkRadio(id,value)">Zelle</label>

                                          </div>
                                          <div class="radio">
                                            <label><input type="radio" name="optradio" id="rotro" value="{{$metodos[0]->otro}}" onclick="checkRadio(id,value)">Otros</label>

                                          </div>
                                          <div id="instrucciones">

                                          </div>
                                      </div>
                                  </div>
                                  <!-- end payment -->

                                    <!-- Shipping Method -->
                                    <div class="single-accordion">
                                        <a class="accordion-head collapsed show" data-toggle="collapse" data-parent="#checkout-accordion" href="#shipping-method">2. Indica tu dirección de entrega</a>
                                        <div id="shipping-method" class="collapse show">
                                            <div class="accordion-body shipping-method fix">
                                              <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                                              <img src="{{asset('public/images/cart/zonas.jpg')}}" width="100%">
                                            </button>
                                                <table class="table table-bordered" width="100%">
                                                  <tr>
                                                    <th style="color:black;">
                                                      Zona:
                                                      <!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
  <i class="fas fa-map-marker-alt"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                      <select class="btn btn-warning" name="zona" id="zona"  onchange="delivery()">
                                                        <option value="">Seleccione su Zona</option>
                                                        @foreach($zonas as $row)
                                                          <option value="{{$row->precio}}">{{$row->nombre}}</option>
                                                        @endforeach
                                                      </select>
                                                    </th>
                                                    </tr>
                                                    <tr style="color:black;">
                                                      <td>Urbanización</td>
                                                      <td><input type="text" name="urbanizacion" value="" required></td>
                                                    </tr>
                                                    <tr style="color:black;">
                                                      <td>Calle</td>
                                                      <td> <input type="text" name="calle" value="" required> </td>
                                                    </tr>
                                                    <tr style="color:black;">
                                                      <td> Casa / Apto. </td>
                                                      <td> <input type="text" name="casa" value="" required> </td>
                                                    </tr>
                                                    <tr style="color:black;">
                                                      <td>Punto de Referencia</td>
                                                      <td> <input type="text" name="referencia" value="" required> </td>
                                                    </tr>
                                                </table>
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
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                            <ul>
                                                <li><p class="strong">Menú</p><p class="strong">total</p></li>
                                                @php $moneda=""; $TOTALcomplementos=0; @endphp
                                                @if(isset($carritos))
                                                @foreach($carritos as $row)
                        												@php $moneda=$row->moneda; $negocio=$row->negocio; @endphp
                                                  <li><p><font color="black">{{$row->nombre}}</font><br> {{$row->moneda}} {{number_format($row->precio,2)}} x {{$row->cantidad}}</p><p>{{$row->moneda}} {{number_format($row->precio*$row->cantidad,2)}}</p></li>
                                                  @if(isset($complementos))
                                                    @php $totalcomplementos=0; @endphp
                                                      @foreach($complementos as $complemento)
                                                        @if($complemento->carrito==$row->id)
                                                          <li><p><font>{{$complemento->nombre}}</font><br> {{$complemento->moneda}} {{number_format($complemento->precio,2)}} x {{$row->cantidad}}</p><p>{{$complemento->moneda}} {{number_format($complemento->precio*$row->cantidad,2)}}</p></li>
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

                                                <li><p class="strong">Subtotal</p><p class="strong">
                                                  {{$moneda}} {{number_format($TOTALcomplementos,2)}}<input type="hidden" name="subtotal" value="{{$TOTALcomplementos}}" id="subtotal" required onkeypress="return false;">
                                                </p></li>
                                                <li><p class="strong">Costo Delivery</p><p>
                                                    <input type="text" name="costodelivery" id="costodelivery" value="" required onkeypress="return false;" placeholder="Debes seleccionar la Zona">
                                                </p></li>
                                                <li><p class="strong">Total a pagar (USD$)</p><p class="strong">
                                                    <label id="labeltotal" style="color:red;font-weight: bold;"></label>
                                                    <input type="hidden" name="total" value="" id="total" readonly>
                                                </p></li>
                                                <li><p class="strong">Tasa de Cambio del negocio</p><p class="strong">
                                                    <label id="labeltasa" style="font-weight: bold;">{{number_format($datosnegocio[0]->tasadecambio,2)}}</label>
                                                    <input type="hidden" name="tasadecambio" value="{{$datosnegocio[0]->tasadecambio}}" id="tasa" readonly>
                                                </p></li>
                                                <li><p class="strong">Total a pagar (Bs.)</p><p class="strong">
                                                  <label id="labeltotalbs" style="color:red;font-weight: bold;"></label>
                                                    <input type="hidden" name="totalbs" value="" id="totalbs" readonly>
                                                </p></li>
                                                <li>
                                                  <p class="strong">Comprobante de pago</p>
                                                  <p class="strong">
                                                    <input class="btm btn-info" type="file" name="archivofoto" class="form-control" required>
                                                  </p>
                                                </li>
                                                <li>
                                                  <p class="strong">Instrucciones o comentarios</p>
                                                  <p class="strong">
                                                    <textarea name="instrucciones" rows="3" width="100%"></textarea>
                                                  </p>
                                                </li>
                                                <li>
                                                  <p class="strong">
                                                    <button class="food__btn">Generar Pedido</button>
                                                  </p>
                                                </li>
                                            </ul>
                                        </form>
                                        <a href="{{env('APP_URL')}}/carrito">
                                          <button class="btn btn-warning">Regresar al carrito</button>
                                        </a>
                                    </div>
                                </div>

                            </div>

                    </div>
                </div>
            </div><!-- Checkout Section End-->
         </section>
         <script type="text/javascript">
           function checkRadio(id,value) {
             instrucciones=document.getElementById("instrucciones");
             instrucciones.innerHTML='<pre>'+value+'</pre>';

           }

           function delivery(){
             var e=document.getElementById("zona");
             var st=document.getElementById("subtotal");
             var t=document.getElementById("total");
             var lt=document.getElementById("labeltotal");
             var ltasa=document.getElementById("labeltasa");

             var tbs=document.getElementById("totalbs");
             var ltbs=document.getElementById("labeltotalbs");
             var tasa=document.getElementById("tasa");

             var costodelivery=document.getElementById("costodelivery");
             costodelivery.value=e.options[e.selectedIndex].value;
             t.value=parseFloat(costodelivery.value)+parseFloat(st.value);

             lt.innerHTML=new Intl.NumberFormat().format(t.value);

             ltasa.innerHTML=new Intl.NumberFormat().format(tasa.value);


             tbs.value=parseFloat(t.value)*parseFloat(tasa.value);
             ltbs.innerHTML=new Intl.NumberFormat().format(tbs.value);

           }
         </script>
@endsection
