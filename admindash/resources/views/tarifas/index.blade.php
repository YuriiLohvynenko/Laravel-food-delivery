@extends('layout')
@section('content')

<div class="app-main__inner">

                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-bicycle icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Tarifas Dashboard
                                        <div class="page-title-subheading">Costos de delivery
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                  <div class="d-inline-block dropdown">
                                    <a href="{{env('APP_URL')}}/zonas">
                                      <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                          <span class="btn-icon-wrapper pr-2 opacity-7">
                                              <i class="fa fa-business-time fa-w-20"></i>
                                          </span>
                                          Ver Zonas
                                      </button>
                                    </a>
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
              <h6 class="m-0 font-weight-bold text-danger">Tarifas</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive bg-white">
                <!-- container varios -->

                <div class="container-perm">
                <!-- fin container -->
                <table class="table table-bordered" id="tabla" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Negocio</th>
                      <th>Zona</th>
                      <th>Costo</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($tarifas as $row)
                    <tr align="center">
                      <td>{{ $row->nombrenegocio }}</td>
                      <td>
                        {{ $row->nombrezona }}
                      </td>
                      <td>{{ $row->moneda }} {{ $row->precio }}</td>
                      <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('tarifas.edit',$row->id) }}">
                              <i class="fas fa-edit"> Editar</i>
                            </a>
                      </td>
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
