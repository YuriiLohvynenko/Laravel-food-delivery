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
                                    <div>Delivery Dashboard
                                        <div class="page-title-subheading">Negocios a los que estas afiliado
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
                <h6 class="m-0 font-weight-bold text-danger">Negocios</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive bg-white">
                  <!-- container varios -->

                  <div class="container-perm">
                  <!-- fin container -->
                  <table class="table table-bordered table-striped" id="tabla" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Negocio</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($choferes as $row)
                      <tr>
                        <td>
                          <p><img src="/deliverydash/public/storage/app/public/uploads/{{$row->logo}}" width="80" alt="Foto del Negocio"></p><br>
                          {{ $row->nombre }}<br>
                          {{ $row->telefono }}<br>
                          @if($row->estatus=="ACTIVO")
                          <form action="{{ route('choferes.update',$row->id) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <input type="hidden" name="id" value="{{$row->id}}">
                                  <input type="hidden" name="estatus" value="INACTIVO">
                                  <b>Mi estatus:</b>
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
                          {{$row->direccion}}<br>
                          <iframe width="100%" height="500" src="https://maps.google.com/maps?q={{str_replace(" ", "+", $row->direccion)}}&output=embed"></iframe>

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
