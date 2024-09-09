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
                                  <div class="d-inline-block">
                                    <a href="{{env('APP_URL')}}/historico">
                                      <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info">
                                          Ver Pedidos Tomados
                                      </button>
                                    </a>
                                  </div>
                                </div>
                            </div>
                        </div>

<div class="container">
    <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-danger">Pedidos disponibles</h6>
    </div>
    <div class="card-body">
      <div class="food__category__wrapper mt--10">
          <div class="row">

            <!-- Start table -->
            <div class="table-content table-responsive bg-white">
                <table class="table table-bordered">
                    <thead>
                        <tr class="title-top bg-wa">
                            <th>Detalle</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="orderhistory">
                      @foreach($pedidos as $row)
                        <tr>
                          <td style="color:black;">
                            <img src="/deliverydash/public/storage/app/public/uploads/{{$row->logo}}" width="90px" alt="Nombre del negocio"><br>
                            <h4>{{$row->nombre}}</h4>

                            <hr>
                              <h5 style="color:red">Pedido Nro. {{$row->id}}</h5>
                              <form action="{{env('APP_URL')}}/pedido/mostrar" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$row->id}}">
                                <button class="btn btn-outline-danger btn-sm" type="submit" name="button">
                                  <i class="zmdi zmdi-assignment"></i> Mostrar
                                </button>
                              </form>
                            <label class="bg-light">Fecha: {{date('d/m/Y h:m A',strtotime($row->created_at))}}</label><br>

                            @switch($row->estatus)
                              @case("PENDIENTE")
                                <label class="bg-warning">Estatus: {{$row->estatus}}
                                  <i class="fas fa-spinner fa-spin"></i>
                                </label>
                                <div class="alert alert-primary" role="alert">
                                  Por favor aceptar, para que el cliente proceda a hacer el pago
                                </div>
                               @break
                               @case("ACEPTADO")
                                 <label class="bg-secondary">Estatus: {{$row->estatus}}
                                   <i class="fas fa-spinner fa-spin"></i>
                                 </label>
                                 <div class="alert alert-primary" role="alert">
                                   Esperando pago del cliente
                                 </div>
                                @break
                                @case("PAGADO")
                                  <label class="bg-warning">Estatus: {{$row->estatus}}
                                    <i class="fas fa-spinner fa-spin"></i>
                                  </label>
                                  <form class="" action="{{env('APP_URL')}}/comprobante" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$row->id}}">
                                    <button class="btn btn-primary" type="submit" name="button">Ver comprobante</button>
                                  </form>
                                  <div class="alert alert-primary" role="alert">
                                    Por favor validar el pago y comenzar la preparación
                                  </div>
                                 @break
                                 @case("APROBADO")
                                   <label class="bg-warning">Estatus: {{$row->estatus}}
                                     <i class="fas fa-spinner fa-spin"></i>
                                   </label>
                                   <div class="alert alert-dark" role="alert">
                                     Puede tomar este pedido, y dirírse al comercio solicitante a retirarlo
                                   </div>
                                   <form action="{{ route('pedidos.update',$row->id) }}" method="POST">
                                     @csrf
                                     @method('PUT')
                                     <input type="hidden" name="estatus" value="ASIGNADO">
                                     <button class="btn btn-primary" type="submit" name="button">Tomar este Pedido</button>
                                   </form>
                                  @break
                                  @case("ESPERANDO DELIVERY")
                                    <label class="bg-warning"><strong>Estatus: {{$row->estatus}}</strong>
                                      <i class="fas fa-spinner"></i>
                                    </label>
                                    <div class="alert alert-dark" role="alert">
                                      <b>Puedes tomar este pedido</b>
                                      <form action="{{ route('pedidos.update',$row->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="estatus" value="EN CAMINO">
                                        <button type="submit" class="btn btn-primary">Tomar para hacer la entrega</button>
                                      </form>
                                    </div>

                                   @break
                                   @case("CANCELADO")
                                     <label class="bg-secondary">Estatus: {{$row->estatus}}
                                     </label>
                                     <div class="alert alert-secondary" role="alert">
                                       El pedido fue Cancelado
                                     </div>
                                    @break
                                    @case("EN CAMINO")
                                      <label class="bg-primary"><strong>Estatus: {{$row->estatus}}</strong>
                                      </label>
                                      <div class="alert alert-primary" role="alert">
                                        <b>En camino</b>
                                        <form action="{{ route('pedidos.update',$row->id) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <input type="hidden" name="estatus" value="ENTREGADO">
                                          <button class="btn btn-success" type="submit" name="button">Indicar que fue Entregado al cliente</button>
                                        </form>
                                      </div>
                                     @break
                            @endswitch
                          </td>
                          <td style="color:black;">{{$row->total}} {{$row->moneda}}</td>

                        </tr>
                      @endforeach
                      <tr>

                      </tr>
                    </tbody>
                  </table>
            </div>

            <!-- FIN table-->

          </div>
      </div>
    </div>
</div>
<script>
 $(document).ready(function(){
    function listdata()
    {
      $.ajax({
        type: "get",
        url: "/delivery/getavailorder",           
        success: function(res) {   
            console.log(res);   
            $('.orderhistory').html("");
            for (let index = 0; index < res.length; index++) 
            {
              var item = "<tr>";
              item += '<td style="color:black;"><img src="/deliverydash/public/storage/app/public/uploads/'+res[index].logo+'" width="90px" alt="Nombre del negocio"><br><h4>'+res[index].nombre+'</h4> <hr><h5 style="color:red">Pedido Nro. '+res[index].id+'</h5><form action="{{env('APP_URL')}}/pedido/mostrar" method="get"><input type="hidden" name="id" value="'+res[index].id+'"><button class="btn btn-outline-danger btn-sm" type="submit" name="button"><i class="zmdi zmdi-assignment"></i> Mostrar</button></form><label class="bg-light">Fecha: '+res[index].created_at+'</label><br>';
              var cnt = res[index].estatus;
             
              switch (cnt) {
                case ("PENDIENTE"):
                    item +='<label class="bg-warning">Estatus: '+res[index].estatus+'<i class="fas fa-spinner fa-spin"></i></label><div class="alert alert-primary" role="alert">Por favor aceptar, para que el cliente proceda a hacer el pago </div>';
                    break;
                case ("ACEPTADO"):
                    item += '<label class="bg-secondary">Estatus: '+res[index].estatus+'<i class="fas fa-spinner fa-spin"></i></label> <div class="alert alert-primary" role="alert">  Esperando pago del cliente </div>';
                    break;
                case ("PAGADO"):
                    item += '<label class="bg-warning">Estatus: '+res[index].estatus+'<i class="fas fa-spinner fa-spin"></i></label><form class="" action="{{env('APP_URL')}}/comprobante" method="get"> <input type="hidden" name="id" value="'+res[index].id+'"><button class="btn btn-primary" type="submit" name="button">Ver comprobante</button></form><div class="alert alert-primary" role="alert">Por favor validar el pago y comenzar la preparación </div>';
                    break;
                case ("APROBADO"):                    
                    item += '<label class="bg-warning">Estatus: '+res[index].estatus+'<i class="fas fa-spinner fa-spin"></i></label><div class="alert alert-dark" role="alert">Puede tomar este pedido, y dirírse al comercio solicitante a retirarlo</div><form action="{{env('APP_URL')}}/pedidos/update/'+res[index].id+'"><input type="hidden" name="estatus" value="ASIGNADO"><button class="btn btn-primary" type="submit" name="button">Tomar este Pedido</button></form>';
                    break;
                
                case ("ESPERANDO DELIVERY"):
                    item +='<label class="bg-warning"><strong>Estatus: '+res[index].estatus+'</strong><i class="fas fa-spinner"></i></label><div class="alert alert-dark" role="alert"><b>Puedes tomar este pedido</b><form action="{{env('APP_URL')}}/pedidos/update/'+res[index].id+'" method="get"> <input type="hidden" name="estatus" value="EN CAMINO"><button type="submit" class="btn btn-primary">Tomar para hacer la entrega</button></form></div>';
                    break;
                case ("CANCELADO"):
                    item +=' <label class="bg-secondary">Estatus: '+res[index].estatus+'</label><div class="alert alert-secondary" role="alert">El pedido fue Cancelado</div>';
                    break;
                case ("EN CAMINO"):
                    item +='<label class="bg-primary"><strong>Estatus: '+res[index].estatus+'</strong></label><div class="alert alert-primary" role="alert"><b>En camino</b><form action="{{env('APP_URL')}}/pedidos/update/'+res[index].id+'" method="get"> <input type="hidden" name="estatus" value="ENTREGADO"><button class="btn btn-success" type="submit" name="button">Indicar que fue Entregado al cliente</button></form></div>';
                    break;
              }
                
              item += '</td> <td style="color:black;">'+res[index].total + res[index].moneda+'</td> </tr>';              
              $('.orderhistory').append(item);  
            }
              
          }        
      });
    }
    listdata();   

    setInterval(function(){
      listdata();
    }, 20000);
  });
</script>
@endsection
