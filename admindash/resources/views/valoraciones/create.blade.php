@extends('layout')
@section('content')
<style media="screen">

*{
  margin: 0;
  padding: 0;
  font-family: roboto;
}

body{
  background: #000;
}

.cont{
  width: 93%;
  max-width: 350px;
  text-align: center;
  margin: 4% auto;
  padding: 30px 0;
  background: #111;
  color: #EEE;
  border-radius: 5px;
  border: thin solid #444;
  overflow: hidden;
}

hr{
  margin: 20px;
  border: none;
  border-bottom: thin solid rgba(255,255,255,.1);
}

div.title{
  font-size: 2em;
}

h1 span{
  font-weight: 300;
  color: #Fd4;
}

div.stars{
  width: 270px;
  display: inline-block;
}

input.star{
  display: none;
}

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content:'*';
  color: #FD4;
  transition: all .25s;
}


input.star-5:checked ~ label.star:before {
  color:#FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before {
  color: #F62;
}

label.star:hover{
  transform: rotate(-15deg) scale(1.3);
}

label.star:before{
  /*content:'\f006';*/
  content:'*';
  /*font-family: FontAwesome;*/
}

.rev-box{
  overflow: hidden;
  height: 0;
  width: 100%;
  transition: all .25s;
}

textarea.review{
  background: #222;
  border: none;
  width: 100%;
  max-width: 100%;
  height: 100px;
  padding: 10px;
  box-sizing: border-box;
  color: #EEE;
}

label.review{
  display: block;
  transition:opacity .25s;
}



input.star:checked ~ .rev-box{
  height: 125px;
  overflow: visible;
}






</style>
<div class="app-main__inner">

                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                        <i class="pe-7s-bicycle icon-gradient bg-mean-fruit">
                                        </i>
                                    </div>
                                    <div>Valoración del Cliente

                                    </div>
                                </div>
                                <div class="page-title-actions">

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


    <form action="{{ route('valoraciones.store') }}" method="POST">
        @csrf
        <input type="hidden" name="pedido" value="{{$pedido}}">
        <input type="hidden" name="usuario" value="{{$usuario}}">
        <input type="hidden" name="tipo" value="2">
              <h5 style="color:black;">¿Cómo calificarías al cliente?</h5>
              <div class="cont">
              <div class="stars">
              <!--<form action="">-->
                <input required class="star star-5" id="star-5-{{$pedido}}" type="radio" name="rating" value="5"/>
                <label class="star star-5" for="star-5-{{$pedido}}"></label>
                <input class="star star-4" id="star-4-{{$pedido}}" type="radio" name="rating" value="4"/>
                <label class="star star-4" for="star-4-{{$pedido}}"></label>
                <input class="star star-3" id="star-3-{{$pedido}}" type="radio" name="rating" value="3"/>
                <label class="star star-3" for="star-3-{{$pedido}}"></label>
                <input class="star star-2" id="star-2-{{$pedido}}" type="radio" name="rating" value="2"/>
                <label class="star star-2" for="star-2-{{$pedido}}"></label>
                <input class="star star-1" id="star-1-{{$pedido}}" type="radio" name="rating" value="1"/>
                <label class="star star-1" for="star-1-{{$pedido}}"></label>
                <div class="rev-box">
                  <textarea class="review" col="30" name="comentario"></textarea>
                  <label class="review" for="review">Deja tu comentario</label>
                </div>
              <!--</form>-->
              </div>
              </div>
              <button type="submit" class="btn btn-success">Enviar</button>


    </form>



<!-- fin main -->
@endsection
