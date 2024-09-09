@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    ACCESO NO AUTORIZADO
                    <form id="logout-form" action="{{ url('logout') }}" method="POST">
                      {{ csrf_field() }}
                      <button class="btn btn-danger" type="submit" name="button">
                          <i class="metismenu-icon pe-7s-back-2"></i>Salir
                      </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
