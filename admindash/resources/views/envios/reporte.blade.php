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
                                    <div>Envíos Dashboard
                                        <div class="page-title-subheading">Reporte de envíos
                                        </div>
                                    </div>

                                </div>
                                <div class="page-title-actions">

                                </div>
                            </div>
                        </div>

<div class="container">
    <div class="card-header py-3">
        @if($chofer)
          <h6 class="m-0 font-weight-bold text-danger">Reporte: {{$chofer[0]->name}}</h6>
        @endif
    </div>
    <div class="row">

      <div class="col">
        <form class="" action="{{env('APP_URL')}}/buscarenvios" method="post">
          @csrf
          @if($envios)
            <input type="hidden" name="id" value="{{ $envios[0]->chofer }}">
          @endif
          <b>Fechas:</b>
          <input type="date" name="desde" id="desde">
          <input type="date" name="hasta" id="hasta">
          <button class="btn btn-danger btn-sm" type="submit" name="button">Buscar</button>
        </form>

        <script type="text/javascript">
          document.getElementById('desde').valueAsDate = new Date();
          document.getElementById('hasta').valueAsDate = new Date();
        </script>
      </div>
    </div>
    <div class="card-body">
      <div class="food__category__wrapper mt--10">
          <div class="row">

            <!-- Start table -->
            <div class="table-content table-responsive bg-white">
                <table class="table table-bordered">
                    <thead>
                        <tr class="title-top bg-wa">
                            <th>Fecha</th>
                            <!--<th>Negocio</th>-->
                            <th>Pedido</th>
                            <th>Zona</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($envios as $row)
                        <tr>
                          <td>{{date('d/m/Y h:m A',strtotime($row->created_at))}}</td>
                          <td style="color:black;">{{$row->pedido}}</td>
                          <td style="color:black;">{{$row->zona}} (${{$row->costodelivery}})</td>
                          <td>
                            <form action="{{env('APP_URL')}}/pedido/mostrar" method="post">
                              @csrf
                              <input type="hidden" name="id" value="{{$row->pedido}}">
                              <button class="btn btn-outline-danger btn-xs" type="submit" name="button">
                                <i class="fa fa-file-invoice-dollar"></i> Mostrar
                              </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            </div>

            <!-- FIN table-->

          </div>
      </div>



    </div>
</div>

@endsection
