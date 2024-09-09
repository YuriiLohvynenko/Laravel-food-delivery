@extends('layout')

@section('content')

<div class="section__title service__align--center bg-danger">
    <!--<p>the process of our service</p>-->
    <h1 style="color:white;">REGISTRAR PAGO</h1>
</div>
<div class="container">
  <div class="row">
      <div class="col">
          <h2 style="color:black;">Métodos de pago disponibles:</h2>
          <div class="radio">
              <label style="color:black;"><input type="radio" name="metodo1" id="rbs" value="{{$metodos[0]->bs}}" onclick="checkRadio(id,value)">Bs. </label>
            </div>
            <div class="radio">
              <label style="color:black;"><input type="radio" name="metodo1" id="refectivousd" value="{{$metodos[0]->usd}}" onclick="checkRadio(id,value)">Efectivo USD$</label>
            </div>
            <div class="radio">
              <label style="color:black;"><input type="radio" name="metodo1" id="rzelle" value="{{$metodos[0]->zelle}}" onclick="checkRadio(id,value)">Zelle</label>

            </div>
            <div class="radio">
              <label style="color:black;"><input type="radio" name="metodo1" id="rotro" value="{{$metodos[0]->otro}}" onclick="checkRadio(id,value)">Otros</label>
            </div>

      </div>
      <div class="col">
        <form action="{{env('APP_URL')}}/pedido/comprobante" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          <h2 style="color:black;">Método de pago seleccionado:</h2>
          <input type="hidden" name="id" value="{{$pedido->id}}">
          <textarea name="metodo" id="metodo" rows="6" style="width:100%" readonly>{{$pedido->metodo}}</textarea>
          <hr>
          <div class="form-group">
                <strong>Comprobante:</strong>
                <input class="btm btn-dark" type="file" name="archivofoto" class="form-control" accept="image/x-png,image/gif,image/jpeg" required>
          </div>
          <div class="form-group">
                <strong>Comprobante 2 (opcional):</strong>
                <input class="btm btn-dark" type="file" name="archivofoto2" class="form-control" accept="image/x-png,image/gif,image/jpeg">
          </div>
          <button class="btn btn-success" type="submit" name="button" data-toggle="modal" data-target="#exampleModal">Registrar Pago</button>
          <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cargando Comprobante</h5>
                  </div>
                  <div class="modal-body">
                      <i class="zmdi zmdi-refresh zmdi-hc-spin zmdi-hc-5x"></i>
                      Cargando Comprobante de pago, por favor espere un momento...
                  </div>
                  <div class="modal-footer">
                  </div>
                </div>
              </div>
            </div>
          <!-- -->
        </form>
      </div>
  </div>
</div>
<script type="text/javascript">
function checkRadio(id,value) {
  instrucciones=document.getElementById("instrucciones");
  instrucciones=document.getElementById("metodo");
  instrucciones.innerHTML='<pre>'+value+'</pre>';
  metodo.innerHTML=value;
  }
</script>


@endsection
