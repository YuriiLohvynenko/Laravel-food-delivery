@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Activar Notificaciones</div>

                <div class="card-body">
                    <form action="{{env('APP_URL')}}/notificaciones" method="post">
                      {{ csrf_field() }}
                      <input name="token" id="token" value="" readonly>
                      <button class="btn btn-danger" type="submit" name="button">
                          Activar
                      </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- token firebase -->
<script type="text/javascript">
messaging.requestPermission()
.then(function(){
    return messaging.getToken();
})
.then(function(token){
    console.log('token generated');
    console.log(token);
    console.log('token generated');
    var tk=document.getElementById("token");
    tk.value=token;
})
.catch(function(err){
    console.log(err);
})
</script>

<!-- token webtoapk -->
<script>
        var tk=document.getElementById("token");
        if(tk.value==""){
          var token = Website2APK.getFirebaseDeviceToken();
          tk.value=token;
        }
</script>
@endsection
