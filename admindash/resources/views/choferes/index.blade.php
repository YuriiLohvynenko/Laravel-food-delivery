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
                                    <div>Choferes Dashboard
                                        <div class="page-title-subheading">Personal que hace la entrega
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">

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
                <h6 class="m-0 font-weight-bold text-danger">Choferes</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive bg-white">
                  <!-- container varios -->

                  <div class="container-perm">
                  <!-- fin container -->
                  <table class="table table-bordered table-striped" id="tabla" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <!--<th>Negocio</th>-->
                        <th>Descripción</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($choferes as $row)
                      <tr>
                        <td>
                          <b>{{ $row->nombre }}</b><br>
                          {{ $row->name }}<br>
                          {{ $row->telefono }}<br>
                          @if($row->estatus=="ACTIVO")
                          <form action="{{ route('choferes.update',$row->id) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <input type="hidden" name="id" value="{{$row->id}}">
                                  <input type="hidden" name="estatus" value="INACTIVO">
                                  <button type="submit" class="btn btn-success xs">ACTIVO</button>
                          </form>
                          @else
                          <form action="{{ route('choferes.update',$row->id) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <input type="hidden" name="id" value="{{$row->id}}">
                                  <input type="hidden" name="estatus" value="ACTIVO">
                                  <button type="submit" class="btn btn-danger xs">INACTIVO</button>
                          </form>
                          @endif
                        </td>

                        <!--<td>{{ $row->nombre }}</td>-->
                        <td>{{ $row->descripcion }}</td>
                        <td>
                          <form class="" action="{{env('APP_URL')}}/reportechofer" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $row->usuario }}">
                            <button type="submit" class="btn btn-info" name="button">Reporte</button>
                          </form>
                        </td>
                        <!--
                        <td>
                          <form action="{{ route('choferes.destroy',$row->id) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <input type="hidden" name="id" value="{{$row->id}}">
                            <a class="btn btn-danger btn-sm" id="eliminar{{$row->id}}">
                                <i class="fa fa-trash" aria-hidden="true" style="color:white;"></i>
                            </a>
                              <button type="submit" class="btn btn-danger btn-sm" id="confirmar{{$row->id}}" style="visibility:hidden;">
                                ¿Confirmar?
                              </button>
                              <script type="text/javascript">
                                document.getElementById("eliminar{{$row->id}}").addEventListener("click", myFunction{{$row->id}});
                                function myFunction{{$row->id}}() {
                                  document.getElementById("eliminar{{$row->id}}").style.visibility = 'hidden';
                                  document.getElementById("confirmar{{$row->id}}").style.visibility = 'visible';
                                }
                              </script>

                          </form>

                        </td>
                      -->
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
