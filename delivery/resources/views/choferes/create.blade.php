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
                                    <div>Choferes Dashboard
                                        <div class="page-title-subheading">Personal que hace la entrega
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block">
                                      <a href="{{ route('choferes.index') }}">
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

<form action="{{ route('choferes.store') }}" method="POST">
    @csrf
     <div class="row">
       <div class="col-xs-6 col-sm-6 col-md-6">
         <div class="form-group">
               <strong>Chofer:</strong><br>
               <select class="btn btn-danger" name="usuario">
                 @foreach($choferes as $row)
                   <option value="{{$row->id}}">{{$row->name}}</option>
                 @endforeach
               </select>
           </div>
       </div>
       <div class="col-xs-6 col-sm-6 col-md-6">
         <div class="form-group">
               <strong>Negocio:</strong><br>
               <select class="btn btn-danger" name="negocio">
                 @foreach($negocios as $row)
                   <option value="{{$row->id}}">{{$row->nombre}}</option>
                 @endforeach
               </select>
           </div>
       </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
                <strong>Descripción:</strong>
                <textarea name="descripcion" rows="8" style="width:100%"></textarea>
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
