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
              <h6 class="m-0 font-weight-bold text-danger">Métodos de pago</h6>
            </div>
            <a class="btn btn-primary btn-sm" href="{{ route('metodos.edit',$metodos[0]->id) }}">
              <i class="fas fa-edit"> Editar</i>
            </a>
            <div class="card-body">
              <div class="row">

                <div class="card-shadow-warning border mb-3 card card-body border-danger">
                  <h5 class="card-title">Pago en Bs.</h5>
                  <pre>{{$metodos[0]->bs}}</pre>
                </div>

                <div class="card-shadow-warning border mb-3 card card-body border-danger">
                      <h5 class="card-title">Pago en USD$ (efectivo)</h5>
                      <pre>{{$metodos[0]->usd}}</pre>
                </div>

                <div class="card-shadow-warning border mb-3 card card-body border-danger">
                        <h5 class="card-title">Pago usando ZELLE</h5>
                        <pre>{{$metodos[0]->zelle}}</pre>
                </div>

                <div class="card-shadow-warning border mb-3 card card-body border-danger">
                        <h5 class="card-title">Otros métodos</h5>
                        <pre>{{$metodos[0]->otro}}</pre>
                </div>



              </div>
            </div>
          </div>
<!-- FIN DATATABLE-->

</div>
@endsection
