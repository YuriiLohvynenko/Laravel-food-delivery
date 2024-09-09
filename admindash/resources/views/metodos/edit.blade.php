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

<form action="{{ route('metodos.update',$metodo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$metodo->id}}">

        <div class="row">

          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                  <strong>Pago en Bs.</strong><br>
                  <textarea name="bs" rows="3" style="width:100%">{{$metodo->bs}}</textarea>
              </div>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                  <strong>Pago en USD$ (efectivo)</strong><br>
                  <textarea name="usd" rows="3" style="width:100%">{{$metodo->usd}}</textarea>
              </div>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                  <strong>Pago usando ZELLE</strong><br>
                  <textarea name="zelle" rows="3" style="width:100%">{{$metodo->zelle}}</textarea>
              </div>
          </div>

          <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                  <strong>Otros métodos</strong><br>
                  <textarea name="otro" rows="3" style="width:100%">{{$metodo->otro}}</textarea>
              </div>
          </div>

       <div class="col-xs-6 col-sm-6 col-md-6">
         <div class="form-group">
               <button type="submit" class="btn btn-success">Modificar</button>
           </div>
       </div>

      </div>
  <!--    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Modificar</button>
        </div>
    </div>-->
</form>


<!-- fin main -->
@endsection
