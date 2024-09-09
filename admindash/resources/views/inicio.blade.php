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
                                    <div>
                                        <div class="page-title-subheading">
                                          Sistemas Administrativo
                                        </div>
                                    </div>

                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block">
                                      <a href="{{env('APP_URL')}}/pedidos">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-business-time fa-w-20"></i>
                                            </span>
                                            Ver Pedidos en curso
                                        </button>
                                      </a>
                                      <a href="{{env('APP_URL')}}/notificaciones">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-warning">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-bell fa-w-20"></i>
                                            </span>
                                            Activar Notificaciones
                                        </button>
                                      </a>
                                      <br><br>
                                      @if($negocio[0]->estatus=='0')
                                      <form action="{{ route('negocios.update',$negocio[0]->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="estatus" value="1">
                                          <button class="btn btn-success btn-lg" type="submit">ABRIR COMERCIO</button>
                                      </form>
                                      @else
                                      <form action="{{ route('negocios.update',$negocio[0]->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="estatus" value="0">
                                        <button class="btn btn-danger btn-lg" type="submit">CERRAR COMERCIO</button>
                                      </form>
                                      @endif

                                    </div>
                                    </div>
                                </div>
                        </div>

<div class="row">
    <div class="col-md-6 col-xl-4">
      <div class="card mb-3 widget-content bg-midnight-bloom">
        <div class="widget-content-wrapper text-white">
          <div class="widget-content-left">
              <div class="widget-heading">Total Pedidos</div>
                <div class="widget-subheading">Pedidos <?php echo date("Y"); ?></div>
                <div>
                      <a class="btn btn-light btn-sm" href="{{env('APP_URL')}}/reporte">
                          <i class="metismenu-icon pe-7s-note2"></i>
                          Reporte
                      </a>
                </div>
          </div>
          <div class="widget-content-right">
              <div class="widget-numbers text-white"><span>{{$pedidos[0]->num}}</span></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-3 widget-content bg-arielle-smile">
        <div class="widget-content-wrapper text-white">
          <div class="widget-content-left">
              <div class="widget-heading">Total Ingresos</div>
                <div class="widget-subheading">Ingresos <?php echo date("Y"); ?></div>
                <div>
                      <a class="btn btn-light btn-sm" href="{{env('APP_URL')}}/reporte">
                          <i class="metismenu-icon pe-7s-note2"></i>
                          Reporte
                      </a>
                </div>
          </div>
          <div class="widget-content-right">
              <div class="widget-numbers text-white"><span>{{$total[0]->num}}</span></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-xl-4">
      <div class="card mb-3 widget-content bg-grow-early">
        <div class="widget-content-wrapper text-white">
          <div class="widget-content-left">
            <div class="widget-heading">Clientes</div>
            <div class="widget-subheading">Que han comprado</div>
            <div>
                  <a class="btn btn-light btn-sm" href="{{env('APP_URL')}}/reporte">
                      <i class="metismenu-icon pe-7s-note2"></i>
                      Reporte
                  </a>
            </div>
          </div>
          <div class="widget-content-right">
            <div class="widget-numbers text-white"><span>{{sizeof($clientes)}}</span></div>
          </div>

        </div>
      </div>
    </div>
</div>
<!--
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
-->
<script src="{{asset('public/js/charts/highcharts.js')}}"></script>
<script src="{{asset('public/js/charts/exporting.js')}}"></script>
<script src="{{asset('public/js/charts/export-data.js')}}"></script>
<script src="{{asset('public/js/charts/accessibility.js')}}"></script>


<div class="row">
  <div class="main-card mb-3 card">
      <div class="card-body">
        <h5 class="card-title">Ventas: Mes Anterior</h5>
            <table class="mb-0 table table-dark">
              <thead>
              <tr>
                <th>Día</th>
                <th>Monto (USD$)</th>
                </tr>
              </thead>
              <tbody>
                @foreach($diasanterior as $row)
                <tr>
                <td>{{$row->dia}}</td>
                <td>{{$row->total}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
  </div>
&nbsp;&nbsp;&nbsp;&nbsp;
<div class="main-card mb-3 card">
    <div class="card-body">
      <h5 class="card-title">Ventas: <?php echo date("M / Y"); ?></h5>
          <table class="mb-0 table table-striped">
            <thead>
            <tr>
              <th>Día</th>
              <th>Monto (USD$)</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dias as $row)
              <tr>
              <td>{{$row->dia}}</td>
              <td>{{$row->total}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
<div class="row">
<figure>
  <div id="container1"></div>
  <p class="highcharts-description">

  </p>
</figure>

<?php
$dia=[];
$totald=[];
$i=0;
$j=0;

foreach ($dias as $row) {
  $dia[$i++]=$row->dia;
  $totald[$j++]=$row->total;
  //echo $row->dia;
}

//print_r($dia);
//print_r($totald);
?>

<script type="text/javascript">
var chart = Highcharts.chart('container1', {

  plotOptions: {
      bar: {
          colorByPoint: true
      }
  },

chart: {
  type: 'bar'
},

title: {
  text: 'Ventas Diarias'
},

subtitle: {
  text: '<?php echo date("M / Y"); ?>'
},

legend: {
  align: 'right',
  verticalAlign: 'middle',
  layout: 'vertical'
},

xAxis: {
  categories:<?php echo json_encode($dia);?>,
  labels: {
    x: -10
  }
},

yAxis: {
  allowDecimals: false,
  title: {
    text: 'USD$'
  }
},

series: [{
  name: 'USD$',
  data: <?php echo json_encode($totald);?>
}],

responsive: {
  rules: [{
    condition: {
      maxWidth: 500
    },
    chartOptions: {
      legend: {
        align: 'center',
        verticalAlign: 'bottom',
        layout: 'horizontal'
      },
      yAxis: {
        labels: {
          align: 'left',
          x: 0,
          y: -5
        },
        title: {
          text: null
        }
      },
      subtitle: {
        text: null
      },
      credits: {
        enabled: false
      }
    }
  }]
}
});



</script>

<div>




<div class="row">

<figure>
  <div id="container2"></div>
  <p class="highcharts-description">

  </p>
</figure>


<!-- charts -->

<?php
$mes=[];
$totalm=[];
$i=0;
$j=0;

foreach ($meses as $row) {
  $mes[$i++]=$row->mes;
  $totalm[$j++]=$row->total;
  //echo $row->dia;
}

//print_r($dia);
//print_r($totald);
?>

<script type="text/javascript">
var chart = Highcharts.chart('container2', {

  plotOptions: {
      column: {
          colorByPoint: true
      }
  },

chart: {
  type: 'column'
},

title: {
  text: 'Ventas Mensuales'
},

subtitle: {
  text: '<?php echo date("Y"); ?>'
},

legend: {
  align: 'right',
  verticalAlign: 'middle',
  layout: 'vertical'
},

xAxis: {
  categories:<?php echo json_encode($mes);?>,
  labels: {
    x: -10
  }
},

yAxis: {
  allowDecimals: false,
  title: {
    text: 'USD$'
  }
},

series: [{
  name: 'USD$',
  data: <?php echo json_encode($totalm);?>
}],

responsive: {
  rules: [{
    condition: {
      maxWidth: 500
    },
    chartOptions: {
      legend: {
        align: 'center',
        verticalAlign: 'bottom',
        layout: 'horizontal'
      },
      yAxis: {
        labels: {
          align: 'left',
          x: 0,
          y: -5
        },
        title: {
          text: null
        }
      },
      subtitle: {
        text: null
      },
      credits: {
        enabled: false
      }
    }
  }]
}
});



</script>
</div>
@endsection
