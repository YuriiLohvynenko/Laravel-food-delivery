@extends('layout')
@section('content')

<div class="app-main__inner">

                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-id icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Negocios Dashboard
                                        <div class="page-title-subheading">Afiliados a la plataforma
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
              <h6 class="m-0 font-weight-bold text-danger">Tu Negocio</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive bg-white">
                <!-- container varios -->
                <div class="">
                  <img class="image img-fluid" src="/deliverydash/public/storage/app/public/uploads/{{ $negocios[0]->foto }}"><br>
                </div>
                <div class="row">
                  <div class="col">
                    <img class="image img-fluid" src="/deliverydash/public/storage/app/public/uploads/{{ $negocios[0]->logo }}" width="150px"><br>
                  </div>
                  <div class="col">
                    <h1>{{ $negocios[0]->nombre }}</h1>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    @if($negocios[0]->estatus=='0')
                    <form action="{{ route('negocios.update',$negocios[0]->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="estatus" value="1">
                        <button class="btn btn-success btn-sm" type="submit">Apertura</button>
                    </form>
                    @else
                    <form action="{{ route('negocios.update',$negocios[0]->id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="estatus" value="0">
                      <button class="btn btn-danger btn-sm" type="submit">Cierre</button>
                    </form>
                    @endif
                    <hr>
                    <a class="btn btn-primary btn-sm" href="{{ route('negocios.edit',$negocios[0]->id) }}">
                      Modificar
                    </a>

                    <a class="btn btn-warning btn-sm" href="{{env('APP_URL')}}/menu/{{$negocios[0]->id}}">
                      Menú
                    </a>
                  </div>
                  <hr>
                  <div class="col-xs-12 col-sm-12 col-md-12 bg-warning">
                    <h3 style="color:red;">Datos</h3>
                  </div>

                   <div class="col-xs-6 col-sm-6 col-md-6">
                     <div class="form-group">
                           <strong>Nombre:</strong>
                           {{$negocios[0]->nombre}}
                       </div>
                   </div>

                   <div class="col-xs-6 col-sm-6 col-md-6">
                     <div class="form-group">
                           <strong>Teléfono:</strong>
                           {{$negocios[0]->telefono}}
                       </div>
                   </div>

                   <div class="col-xs-6 col-sm-6 col-md-6">
                     <div class="form-group">
                           <strong>Dirección:</strong>
                           {{$negocios[0]->direccion}}
                       </div>
                   </div>
                   <div class="col-xs-6 col-sm-6 col-md-6">
                     <div class="form-group">
                           <strong>Sector:</strong>
                           {{$negocios[0]->sector}}
                       </div>
                   </div>

                   <div class="col-xs-4 col-sm-4 col-md-4">
                     <div class="form-group">
                           <strong>Latitud:</strong>
                           {{$negocios[0]->latitud}}
                       </div>
                   </div>
                   <div class="col-xs-4 col-sm-4 col-md-4">
                     <div class="form-group">
                           <strong>Longitud:</strong>
                           {{$negocios[0]->longitud}}
                       </div>
                   </div>

                   <div class="col-xs-4 col-sm-4 col-md-4">
                     <div class="form-group">
                       <form action="{{ route('negocios.update',$negocios[0]->id) }}" method="POST">
                         @csrf
                         @method('PUT')
                           <strong>Tasa de cambio (Bs -> USD):</strong>
                           <input type="text" name="tasadecambio" value="{{$negocios[0]->tasadecambio}}" style="width:25%">
                           <button type="submit" class="btn btn-dark" name="button">Actualizar</button>
                        </form>
                       </div>
                   </div>

                   <div class="col-xs-12 col-sm-12 col-md-12 bg-warning">
                     <h3 style="color:red;">Horarios (Formato 24Hrs.)</h3>
                   </div>

                   <div class="col-xs-3 col-sm-4 col-md-3">
                     <div class="form-group">
                           <strong>Lunes:</strong>
                           De: {{$negocios[0]->lunesa}}:00
                           a: {{$negocios[0]->lunesc}}:00
                       </div>
                   </div>
                   <div class="col-xs-3 col-sm-4 col-md-3">
                     <div class="form-group">
                           <strong>Martes:</strong>
                           De: {{$negocios[0]->martesa}}:00
                           a: {{$negocios[0]->martesc}}:00
                       </div>
                   </div>
                   <div class="col-xs-3 col-sm-4 col-md-3">
                     <div class="form-group">
                           <strong>Miércoles:</strong>
                           De: {{$negocios[0]->miercolesa}}:00
                           a: {{$negocios[0]->miercolesc}}:00
                       </div>
                   </div>
                   <div class="col-xs-3 col-sm-4 col-md-3">
                     <div class="form-group">
                           <strong>Jueves:</strong>
                           De: {{$negocios[0]->juevesa}}:00
                           a: {{$negocios[0]->juevesc}}:00
                       </div>
                   </div>
                   <div class="col-xs-3 col-sm-4 col-md-3">
                     <div class="form-group">
                           <strong>Viernes:</strong>
                           De: {{$negocios[0]->viernesa}}:00
                           a: {{$negocios[0]->viernesc}}:00
                       </div>
                   </div>
                   <div class="col-xs-3 col-sm-4 col-md-3">
                     <div class="form-group">
                           <strong>Sábado:</strong>
                           De: {{$negocios[0]->sabadoa}}:00
                           a: {{$negocios[0]->sabadoc}}:00
                       </div>
                   </div>
                   <div class="col-xs-3 col-sm-4 col-md-3">
                     <div class="form-group">
                           <strong>Domingo:</strong>
                           De: {{$negocios[0]->domingoa}}:00
                           a: {{$negocios[0]->domingoc}}:00
                       </div>
                   </div>

              </div>
            </div>
          </div>
<!-- FIN DATATABLE-->

</div>
@endsection
