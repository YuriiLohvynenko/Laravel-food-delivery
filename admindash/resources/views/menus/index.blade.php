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
                                    <div>Menús Dashboard
                                        <div class="page-title-subheading">Platillos que ofrece el afiliado
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
              <h6 class="m-0 font-weight-bold text-danger">Menú</h6>
            </div>
            <div class="card-body">
                <!-- container varios -->
                @foreach ($menus as $row)
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-12 bg-warning">
                    <h3 style="color:red;">{{ $row->nombre }}</h3>
                  </div>

                  <div class="col">
                    <img class="image img-fluid" src="/deliverydash/public/storage/app/public/uploads/{{ $row->foto }}">
                    <br>
                    @if($row->disponible)
                    <form action="{{ route('menus.update',$row->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="disponible" value="0">
                            <button type="submit" class="btn btn-danger">Cambiar a Agotado</button>
                    </form>
                    @else
                    <form action="{{ route('menus.update',$row->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="disponible" value="1">
                            <button type="submit" class="btn btn-success">Cambiar a Disponible</button>
                    </form>
                    @endif
                  </div>

                  <div class="col">
                    <i class="fas fa-utensils text-danger"></i> {{ $row->nombrenegocio }}<br>
                    <i class="fas fa-dollar-sign text-danger"></i> {{ $row->precio }} {{ $row->moneda }}<br>
                    <label class="text-danger"><b>Incluye:</b></label><br>
                    <textarea name="name" rows="5" readonly>{{ $row->descripcion }}</textarea><br>
                    <a class="btn btn-primary btn-sm" href="{{ route('menus.edit',$row->id) }}">
                      <i class="fas fa-edit">Editar</i>
                    </a>
                  </div>
                </div>
                @endforeach



            </div>
          </div>
<!-- FIN DATATABLE-->

</div>
@endsection
