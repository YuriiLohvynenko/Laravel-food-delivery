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
                                    <div>Tarifas Dashboard
                                        <div class="page-title-subheading">Costos de Delivery
                                        </div>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <div class="d-inline-block">
                                      <a href="{{ route('tarifas.index') }}">
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

<form action="{{ route('tarifas.update',$tarifa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{$tarifa->id}}">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                  <strong>Zona:</strong><br>
                    @foreach($zonas as $row)
                      <?php if($row->id==$tarifa->zona){ echo $row->nombre; } ?>
                    @endforeach
                    

              </div>
          </div>


           <div class="col-xs-6 col-sm-6 col-md-6">
             <div class="form-group">
                   <strong>Precio:</strong><br>
                   <input type="number" name="precio" min="0.00" step="0.01" placeholder="0.00" value="{{$tarifa->precio}}"/>
                   <select class="btn-light" name="moneda">
                       <option value="USD$" <?php if($tarifa->moneda=='USD$'){ echo "selected"; } ?> >USD$</option>
                       <option value="Bs." <?php if($tarifa->moneda=='Bs.'){ echo "selected"; } ?> >Bs.</option>
                   </select>
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
<img class="image img-fluid" src="{{asset('public/images/zonas.jpg')}}" width="100%">

<!-- fin main -->
@endsection
