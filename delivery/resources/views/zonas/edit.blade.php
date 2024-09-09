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
                                    <div>Zonas Dashboard
                                        <div class="page-title-subheading">Zonas de la Ciudad donde se hace el delivery
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block">
                                      <a href="{{ route('zonas.index') }}">
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

<form action="{{ route('zonas.update',$zona->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$zona->id}}">

        <div class="row">

           <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
                   <strong>Nombre:</strong>
                   <input type="text" name="nombre" class="form-control" value="{{$zona->nombre}}">
               </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-group">
                   <strong>Descripción:</strong><br>
                   <textarea name="descripcion" rows="8" style="width:100%">{{$zona->descripcion}}</textarea>
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
