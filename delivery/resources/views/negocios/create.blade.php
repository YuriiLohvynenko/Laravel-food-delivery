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
                                    <div class="d-inline-block">
                                      <a href="{{ route('negocios.index') }}">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" class="btn-shadow btn btn-danger">
                                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                                <i class="fa fa-undo fa-w-20"></i>
                                            </span>
                                            Regresar
                                        </button>
                                      </a>
                                    </div>
                                    </div>
                                </div>
                        </div>

<!-- main section -->
<div class="row">
  @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif
</div>

<form action="{{ route('negocios.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <div class="row">

       <div class="col-xs-12 col-sm-12 col-md-12 bg-warning">
         <h3 style="color:red;">Datos</h3>
       </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="nombre" class="form-control">
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
                <strong>Teléfono:</strong>
                <input type="text" name="telefono" class="form-control">
            </div>
        </div>


        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
                <strong>Dirección:</strong>
                <input type="text" name="direccion" class="form-control">
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
                <strong>Sector:</strong>
                <input type="text" name="sector" class="form-control">
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
          <div class="form-group">
                <strong>Latitud:</strong>
                <input type="text" name="latitud" class="form-control">
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
          <div class="form-group">
                <strong>Longitud:</strong>
                <input type="text" name="longitud" class="form-control">
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
          <div class="form-group">
                <strong>Tasa de cambio (Bs -> USD):</strong>
                <input type="text" name="tasadecambio" class="form-control">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 bg-warning">
          <h3 style="color:red;">Horarios (Formato 24Hrs.)</h3>
        </div>

        <div class="col-xs-3 col-sm-4 col-md-3">
          <div class="form-group">
                <strong>Lunes:</strong><br>
                De: <input type="number" name="lunesa" size="2" min="0" max="24" value="0" />
                a: <input type="number" name="lunesc" size="2" min="0" max="24" value="24" />
            </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-3">
          <div class="form-group">
                <strong>Martes:</strong><br>
                De: <input type="number" name="martesa" size="2" min="0" max="24" value="0" />
                a: <input type="number" name="martesc" size="2" min="0" max="24" value="24" />
            </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-3">
          <div class="form-group">
                <strong>Miércoles:</strong><br>
                De: <input type="number" name="miercolesa" size="2" min="0" max="24" value="0" />
                a: <input type="number" name="miercolesc" size="2" min="0" max="24" value="24" />
            </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-3">
          <div class="form-group">
                <strong>Jueves:</strong><br>
                De: <input type="number" name="juevesa" size="2" min="0" max="24" value="0" />
                a: <input type="number" name="juevesc" size="2" min="0" max="24" value="24" />
            </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-3">
          <div class="form-group">
                <strong>Viernes:</strong><br>
                De: <input type="number" name="viernesa" size="2" min="0" max="24" value="0" />
                a: <input type="number" name="viernesc" size="2" min="0" max="24" value="24" />
            </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-3">
          <div class="form-group">
                <strong>Sábado:</strong><br>
                De: <input type="number" name="sabadoa" size="2" min="0" max="24" value="0" />
                a: <input type="number" name="sabadoc" size="2" min="0" max="24" value="24" />
            </div>
        </div>
        <div class="col-xs-3 col-sm-4 col-md-3">
          <div class="form-group">
                <strong>Domingo:</strong><br>
                De: <input type="number" name="domingoa" size="2" min="0" max="24" value="0" />
                a: <input type="number" name="domingoc" size="2" min="0" max="24" value="24" />
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 bg-warning">
          <h3 style="color:red;">Imagen</h3>
        </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
      <div class="form-group">
            <strong>Categoria:</strong><br>
            <select class="btn btn-danger" name="categoria">
              @foreach($categorias as $row)
                <option value="{{$row->id}}">{{$row->nombre}}</option>
              @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
      <div class="form-group">
            <strong>Logo:</strong>
             <input class="btm btn-info" type="file" name="archivologo" class="form-control" required>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
      <div class="form-group">
            <strong>Foto:</strong>
            <input class="btm btn-info" type="file" name="archivofoto" class="form-control" required>
        </div>
    </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Guardar</button>
        </div>
    </div>
</form>

<!-- fin main -->
@endsection
