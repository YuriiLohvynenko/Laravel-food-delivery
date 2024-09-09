@extends('layout')
@section('content')
@php
$user = auth()->user();
if($user->rol=="0"){
  header("Location: ".env("APP_URL")."/mensaje/Usuario no Autorizado");
  exit;
}
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                 Por favor Seleccione Usuario:
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('cambia.password') }}">
                        @csrf
                        <select name="userid" id="userid">
                          @foreach ($users as $row)
                          <option value="{{ $row->id }}">{{ $row->name }} - {{ $row->email }}</option>
                          @endforeach
                        </select>
                       <hr>
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nueva Contraseña</label>
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Confirmar Nueva</label>
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    Cambiar Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                    <a href="{{env("APP_URL")}}"><button class="btn btn-success" style="float:right;">
                        Regresar
                    </button></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
