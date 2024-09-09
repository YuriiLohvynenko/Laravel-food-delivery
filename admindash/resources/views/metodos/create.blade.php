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
                                    <div>Métodos de Pago Dashboard
                                        <div class="page-title-subheading">Instrucciones para cada método de pago
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block">
                                      <a href="{{ route('metodos.index') }}">
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

<div class="col-xs-12 col-sm-12 col-md-12 bg-warning">
  <h3 style="color:red;">Instrucciones para hacer los pagos</h3>
</div>

<form action="{{ route('metodos.store') }}" method="POST">
    @csrf
     <div class="row">
       <div class="col-xs-12 col-sm-12 col-md-12">
         <div class="form-group">
               <strong>Negocio:</strong><br>
               <select class="btn btn-danger" name="negocio">
                 @foreach($negocios as $row)
                   <option value="{{$row->id}}">{{$row->nombre}}</option>
                 @endforeach
               </select>
           </div>
       </div>



        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
                <strong>Pago en Bs.</strong><br>
                <textarea name="bs" rows="3" style="width:100%"></textarea>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
                <strong>Pago en USD$ (efectivo)</strong><br>
                <textarea name="usd" rows="3" style="width:100%"></textarea>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
                <strong>Pago usando ZELLE</strong><br>
                <textarea name="zelle" rows="3" style="width:100%"></textarea>
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
                <strong>Otros métodos</strong><br>
                <textarea name="otro" rows="3" style="width:100%"></textarea>
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
