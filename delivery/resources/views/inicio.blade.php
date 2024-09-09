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
                                    <div>Dashboard
                                        <div class="page-title-subheading">
                                          Sistemas Administrativo de PídemeOnLine
                                        </div>
                                    </div>

                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block">
                                      <a href="{{env('APP_URL')}}/pedidos">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-success">
                                            Pedidos Disponibles
                                        </button>
                                      </a>
                                      <a href="{{env('APP_URL')}}/historico">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info">
                                            Pedidos Tomados
                                        </button>
                                      </a>
                                    </div>
                                    </div>
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                              <div class="card mb-3 widget-content bg-midnight-bloom">
                                <div class="widget-content-wrapper text-white">
                                  <div class="widget-content-left">
                                      <div class="widget-heading">Total Entregas</div>
                                        <div class="widget-subheading">Entregas <?php echo date("Y"); ?></div>
                                        <div>
                                              <a class="btn btn-light btn-sm" href="{{env('APP_URL')}}/reporte">
                                                  <i class="metismenu-icon pe-7s-note2"></i>
                                                  Reporte
                                              </a>
                                        </div>
                                  </div>
                                  <div class="widget-content-right">
                                      <div class="widget-numbers text-white"><span>{{$envios[0]->num}}</span></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                              <div class="card mb-3 widget-content bg-arielle-smile">
                                <div class="widget-content-wrapper text-white">
                                  <div class="widget-content-left">
                                      <div class="widget-heading">Total Entregas Mes</div>
                                        <div class="widget-subheading">Entregas <?php echo date("M"); ?></div>
                                        <div>
                                              <a class="btn btn-light btn-sm" href="{{env('APP_URL')}}/reporte">
                                                  <i class="metismenu-icon pe-7s-note2"></i>
                                                  Reporte
                                              </a>
                                        </div>
                                  </div>
                                  <div class="widget-content-right">
                                      <div class="widget-numbers text-white"><span>{{$enviosmes[0]->num}}</span></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                              <div class="card mb-3 widget-content bg-grow-early">
                                <div class="widget-content-wrapper text-white">
                                  <div class="widget-content-left">
                                    <div class="widget-heading">Entregas Día</div>
                                    <div class="widget-subheading">Realizadas Hoy</div>
                                    <div>
                                          <a class="btn btn-light btn-sm" href="{{env('APP_URL')}}/reporte">
                                              <i class="metismenu-icon pe-7s-note2"></i>
                                              Reporte
                                          </a>
                                    </div>
                                  </div>
                                  <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{$enviosdia[0]->num}}</span></div>
                                  </div>

                                </div>
                              </div>
                            </div>
                        </div>


<script src="{{asset('public/js/charts/highcharts.js')}}"></script>
<script src="{{asset('public/js/charts/exporting.js')}}"></script>
<script src="{{asset('public/js/charts/export-data.js')}}"></script>
<script src="{{asset('public/js/charts/accessibility.js')}}"></script>

<div class="row">

<div class="main-card mb-3 card">
    <div class="card-body">
      <h5 class="card-title">Entregas: <?php echo date("M / Y"); ?></h5>
          <table class="mb-0 table table-striped">
            <thead>
            <tr>
              <th>Día</th>
              <th>Entregas</th>
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
&nbsp;&nbsp;&nbsp;&nbsp;
<div class="main-card mb-3 card">
    <div class="card-body">
      <h5 class="card-title">Entregas: <?php echo date("Y"); ?></h5>
          <table class="mb-0 table table-striped">
            <thead>
            <tr>
              <th>Mes</th>
              <th>Entregas</th>
              </tr>
            </thead>
            <tbody>
              @foreach($meses as $row)
              <tr>
              <td>{{$row->mes}}</td>
              <td>{{$row->total}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
</div>

</div>

<!--- GRAFICOS -->
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
  text: 'Entregas Diarias'
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
    text: 'Nro.'
  }
},

series: [{
  name: 'Nro.',
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



<!-- 2do grafico -->

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
  text: 'Entregas Mensuales'
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
    text: 'Nro.'
  }
},

series: [{
  name: 'Nro.',
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
