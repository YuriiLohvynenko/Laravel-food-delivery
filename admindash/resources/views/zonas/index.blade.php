@extends('layout')
@section('content')

<div class="app-main__inner">

                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-map-2 icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Zonas Dashboard
                                        <div class="page-title-subheading">Zonas de la Ciudad donde se hace el delivery.
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                  <div class="d-inline-block dropdown">
                                    <a href="{{env('APP_URL')}}/tarifas">
                                      <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                          <span class="btn-icon-wrapper pr-2 opacity-7">
                                              <i class="fa fa-business-time fa-w-20"></i>
                                          </span>
                                          Tarifas
                                      </button>
                                    </a>
                                  </div>
                                </div>
                            </div>
                        </div>
<div class="row">
  @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif

<!-- DataTable Grupos -->
          <div class="container">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-danger">Zonas</h6>
            </div>
            <!--<img class="image img-fluid" src="{{asset('public/images/zonas.jpg')}}" width="100%">-->
            <!--Carousel Wrapper-->
              <div id="carousel-example-1z" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
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
                    <img class="d-block w-100" src="{{asset('public/images/zonas.jpg')}}" alt="Puerto Ordaz">
                  </button>
                  </div>
                  <!--/First slide-->
                  <!--Second slide-->
                  <div class="carousel-item">
                    <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
                    <img class="d-block w-100" src="{{asset('public/images/zonas1.jpg')}}" alt="San Félix">
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
            <div class="card-body">
              <div class="table-responsive bg-white">
                <!-- container varios -->

                <div class="container-perm">
                <!-- fin container -->

                <table class="table table-bordered" id="tabla" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($zonas as $row)
                    <tr>
                      <td>{{ $row->nombre }}</td>
                      <td>{{ $row->descripcion }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
<!-- FIN DATATABLE-->

</div>
@endsection
