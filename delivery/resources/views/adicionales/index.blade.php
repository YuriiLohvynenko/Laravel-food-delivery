@extends('layout')
@section('content')

<div class="app-main__inner">

                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Adicionales Dashboard
                                        <div class="page-title-subheading">Complementos de los menús
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block">
                                      <a href="{{ route('adicionales.create') }}">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-info">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-plus-square fa-w-20"></i>
                                            </span>
                                            Crear
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
              <h6 class="m-0 font-weight-bold text-danger">Adicionales</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive bg-white">
                <!-- container varios -->

                <div class="container-perm">
                <!-- fin container -->
                <table class="table table-bordered table-striped" id="tabla" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Adicional</th>
                      <th>Precio</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($adicionales as $row)
                    <tr>
                      <td>
                        <i class="fas fa-utensils text-danger"></i> {{ $row->nombrenegocio }}<br>
                        <b>{{ $row->nombre }}</b><br>
                        @if($row->disponible)
                        <form action="{{ env('APP_URL') }}/adicional/disponible" method="POST">
                                @csrf
                                <input type="hidden" name="disponible" value="0">
                                <input type="hidden" name="id" value="{{$row->id}}">
                                <button type="submit" class="btn btn-danger">Cambiar a Agotado</button>
                        </form>
                        @else
                        <form action="{{ env('APP_URL') }}/adicional/disponible" method="POST">
                                @csrf
                                <input type="hidden" name="disponible" value="1">
                                <input type="hidden" name="id" value="{{$row->id}}">
                                <button type="submit" class="btn btn-success">Cambiar a Disponible</button>
                        </form>
                        @endif
                      </td>
                      <td>{{ $row->precio }} {{ $row->moneda }}<br></td>
                      <td>
                          <a class="btn btn-primary btn-sm" href="{{env('APP_URL')}}/adicional/{{$row->id}}/modificar">
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
