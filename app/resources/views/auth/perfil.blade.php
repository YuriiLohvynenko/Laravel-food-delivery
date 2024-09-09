@extends('layout')

@section('content')
<style media="screen">
  h2, p{
    color:black;
  }

  .btn-file {
    position: relative;
    overflow: hidden;
  }
  .btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 50px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
  }

</style>
<div class="container">
  <div class="col-md-12 col-lg-12">
      <div class="section__title service__align--center bg-danger">
          <h1 style="color:white;">Perfil de Usuario</h1>
      </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-5">
      <figure>
          <img src="/app/public/storage/app/public/uploads/{{ $user->foto }}" alt="" class="img-circle img-responsive" width="150">
          <form action="{{env('APP_URL')}}/foto" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
              <input type="hidden" name="foto" value="{{ $user->foto }}">
              <span class="btn btn-primary btn-file btn-sm">
                <i class="zmdi zmdi-camera"></i><input type="file" id="img" name="img" accept="image/*" required>
              </span>
              <button type="submit" class="btn btn-warning btn-sm" name="button">Cambiar</button>
          </form>
          <figcaption class="ratings">
                @for($i=0;$i<$ratingcli;$i++)
                  <i class="zmdi zmdi-star" style="color:#ffe700"></i>
                @endfor
                @for($j=$i;$j<5;$j++)
                  <i class="zmdi zmdi-star"></i>
                @endfor
                <i class="zmdi zmdi-thumb-up" style="color:red;">{{$compras[0]->num}}</i>
          </figcaption>
      </figure>
    </div>

    <div class="col-7">
      <h2>{{$user->name}}</h2>
      <a class="btn btn-info btn-sm" href="{{ route('perfil.edit',$user->id) }}"><i class="zmdi zmdi-edit">Editar</i></a>
      <p><strong>Cédula: </strong>{{$user->cedula}}</p>
      <p><strong>Teléfono: </strong> {{$user->telefono}} </p>
      <p><strong>Email: </strong></p><p> {{$user->email}} </p>

    </div>

  </div>
<hr style="border: 1px solid red; border-radius: 0px;">
  <h1 style="color:red;">Tus valoraciones</h1>
<hr style="border: 1px solid red; border-radius: 0px;">
<div class="table-responsive">
  <table>
    <tr>
      <th>Pedido</th>
      <th>Comentario</th>
    </tr>
    @foreach($valoraciones as $row)
    <tr>
      <td>
        {{$row->pedido}}
      </td>
      <td>
        @for($i=0;$i<$row->rating;$i++)
          <i class="zmdi zmdi-star" style="color:#ffe700"></i>
        @endfor
        @for($j=$i;$j<5;$j++)
          <i class="zmdi zmdi-star"></i>
        @endfor
        <br>
        {{$row->comentario}}
      </td>
    </tr>
    @endforeach
  </table>
</div>






@endsection
