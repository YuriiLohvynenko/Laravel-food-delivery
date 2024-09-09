@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pideme OnLine</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Has ingresado, por favor continúa con tu pedido<hr>
                    <a href="{{env('APP_URL')}}">
                      <button class="btn btn-danger">CONTINUAR</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
