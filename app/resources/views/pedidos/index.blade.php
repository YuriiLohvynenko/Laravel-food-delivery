@extends('layout')

@section('content')
<!-- Start Food Category -->
<section class="bg--white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="section__title service__align--center bg-danger">
                    <h1 style="color:white;">PEDIDOS EN CURSO</h1>
                </div>
            </div>
        </div>
        <div class="">
            <div class="row">

              <!-- Start table -->
              <div class="table-content table-responsive">
                  <table class="table table-bordered">
                      <thead>
                          <tr class="title-top">
                              <th>Detalle</th>
                              <th>Total</th>
                          </tr>
                      </thead>
                      <tbody class="listarea">
                       
                      </tbody>
                    </table>
              </div>
              <!-- FIN table-->
              <div class="" style="margin: 0 auto; width: 100px;">
                <a class="btn btn-success" href="{{env('APP_URL')}}/historicos">Ver Pedidos Anteriores</a>
              </div>

            </div>
        </div>
    </div>
</section>
<script>
  $(document).ready(function(){
    function listdata()
    {
      $.ajax({
        type: "get",
        url: "/app/getuserorder",           
        success: function(res) {               
            $('.listarea').html("");
            for (let index = 0; index < res.length; index++) {
              var item = "<tr>";
              item += "<td style='color:black;''>";
              item += '<img src="/deliverydash/public/storage/app/public/uploads/';
              item += res[index].logo;
              item += '" width="90px" alt="Nombre del negocio"><br>';
              item += '<h4>'+res[index].nombre+'</h4>';
              item += '<hr>';
              item += '<h4 style="color:red;">Pedido Nro. '+res[index].id+'</h4>';
              item += '<form action="{{env('APP_URL')}}/pedido/mostrar" method="post">';
              item += '@csrf';
              item += '<input type="hidden" name="id" value="'+res[index].id+'">';
              item += '<button class="btn btn-outline-danger btn-sm" type="submit" name="button">';
              item += '<i class="zmdi zmdi-assignment"></i> Mostrar';
              item += '</button>';
              item += '</form>';
              item += '<hr>';
              item += '<label class="bg-light">Fecha: '+res[index].created_at+'</label><br>';
              var cnt = res[index].estatus;              
              switch (cnt) {
                case ("PENDIENTE"):
                      item +='<label class="bg-warning"><strong>Estatus: '+res[index].estatus+'</strong><i class="zmdi zmdi-spinner zmdi-hc-spin"></i></label>';
                      item +='<form action="{{env('APP_URL')}}/pedidos/update/'+res[index].id+'" method="POST">';
                      item +='@csrf';
                      item +='<button class="btn btn-danger" type="submit" name="button">Cancelar Pedido</button>';
                      item +='<textarea name="instrucciones" rows="1" style="width:100%" placeholder="Indique el motivo" required></textarea>';
                      item +='</form>';
                    break;
                case ("ACEPTADO"):
                    item += '<label class="bg-warning"><strong>Estatus: '+res[index].estatus+'</strong><i class="zmdi zmdi-spinner zmdi-hc-spin"></i></label><div class="alert alert-dark" role="alert"><b>Por favor proceder a realizar el pago y luego registrar el comprobante</b></div><a class="btn btn-success" href="{{env('APP_URL')}}/pedido/'+res[index].id+'/pagar">Registrar comprobante de pago</a>';
                    break;
                case ("PAGADO"):
                    item += '<label class="bg-warning"><strong>Estatus: '+res[index].estatus+'</strong><i class="zmdi zmdi-spinner zmdi-hc-spin"></i></label><div class="alert alert-dark" role="alert"><b>En espera de que el negocio valide el pago</b></div>';
                    break;
                case ("APROBADO"):                    
                    item += '<label class="bg-warning"><strong>Estatus: '+res[index].estatus+'</strong><i class="zmdi zmdi-spinner zmdi-hc-spin"></i></label><div class="alert alert-dark" role="alert"><b>Ya tu pedido esta preparándose</b></div>';
                    if(res[index].zona == "RETIRO EN TIENDA")
                    {
                      item += '<div class="alert alert-success" role="alert"><b>Dirígete al comercio a retirar tu pedido</b></div>';
                    }
                    break;
                case ("ASIGNADO"):
                    item += '<label class="bg-warning"><strong>Estatus: '+res[index].estatus+'</strong><i class="zmdi zmdi-spinner zmdi-hc-spin"></i></label><div class="alert alert-dark" role="alert"><b>Ya tu pedido esta preparándose</b></div>'
                    break;
                case ("ESPERANDO DELIVERY"):
                    item +='<label class="bg-success"><strong>Estatus: '+res[index].estatus+'</strong><i class="zmdi zmdi-spinner"></i></label><div class="alert alert-success" role="alert"><b>Tu pedido está a la espera de que el delivery lo pase buscando</b></div><form action="{{env('APP_URL')}}/pedidos/update/'+res[index].id+'" method="POST"> <input type="hidden" name="estatus" value="ENTREGADO"><button class="btn btn-success" type="submit" name="button">Indica que lo recibiste</button></form>';
                    break;
                case ("EN CAMINO"):
                    item +='<label class="bg-success"><a href="/app/view_delivery/'+res[index].id+'"><strong>Estatus: '+res[index].estatus+'</strong></a></label><div class="alert alert-dark" role="alert"><b>Ya tu pedido esta en camino</b></div>';
                    break;
              }
                
              item += "</td>";
              item += '<td style="color:black;">'+res[index].total+ res[index].moneda;
              item += "</td>";
              item += "</tr>";              
              $('.listarea').append(item);    
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
