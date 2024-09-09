@php
$user = auth()->user();

if($user->rol!="3"){
  header("Location: ".env("APP_URL")."/noautorizado");
  exit;
}
@endphp
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pídeme.com | Sistema Delivery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('public/images/logo100x100.png')}}">
    <link rel="apple-touch-icon" href="{{ asset ('public/images/logo.png')}}">

<link href="{{ asset('public/main.css') }}" rel="stylesheet">
<link href="{{ asset('public/custom.css') }}" rel="stylesheet">
<script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
<script src="{{ asset ('public/js/sweetalert2.all.js')}}"></script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
       <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-app.js"></script>
           <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-messaging.js"></script>

       <!-- TODO: Add SDKs for Firebase products that you want to use
           https://firebase.google.com/docs/web/setup#config-web-app -->

       <script>
           // Your web app's Firebase configuration
           var firebaseConfig = {
             apiKey: "AIzaSyAR130WRwVLZYp8-vUra6qrqtoA3qAEZiw",
             authDomain: "pidemeonline-c9a62.firebaseapp.com",
             databaseURL: "https://pidemeonline-c9a62.firebaseio.com",
             projectId: "pidemeonline-c9a62",
             storageBucket: "pidemeonline-c9a62.appspot.com",
             messagingSenderId: "302403651887",
             appId: "1:302403651887:web:a46cb7d072c8dea96679da",
             measurementId: "G-370WJCKHQL"
           };
           // Initialize Firebase
           firebase.initializeApp(firebaseConfig);
           const messaging = firebase.messaging();
       </script>
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>

        </div>

         <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                              <a href="{{env('APP_URL')}}">
                                <img src="{{ asset('public/images/logo100x100.png')}}"><br>
                              </a>
                                {{Auth::user()->name}}
                                <li class="app-sidebar__heading text-danger">Dashboard</li>
                                <li>
                                    <a href="{{env('APP_URL')}}">
                                        <i class="metismenu-icon pe-7s-display1"></i>
                                        Analítica
                                    </a>
                                    <a href="{{env('APP_URL')}}/pedidos">
                                        <i class="metismenu-icon pe-7s-cart"></i>
                                        Pedidos disponibles
                                    </a>
                                    <a href="{{env('APP_URL')}}/historico">
                                        <i class="metismenu-icon pe-7s-search"></i>
                                        Histórico
                                    </a>
                                </li>

                                <!-- titulo menu -->
                                <li class="app-sidebar__heading text-danger">Delivery</li>
                                <li>
                                  <a href="{{env('APP_URL')}}/notificaciones">
                                      <i class="metismenu-icon pe-7s-comment"></i>
                                      Notificaciones
                                  </a>
                                </li>
                                <li>
                                  <a href="{{env('APP_URL')}}/choferes">
                                      <i class="metismenu-icon pe-7s-id"></i>
                                      Negocios
                                  </a>
                                </li>
                                <li>
                                  <a href="{{env('APP_URL')}}/zonas">
                                      <i class="metismenu-icon pe-7s-map-2"></i>
                                      Zonas
                                  </a>
                                </li>

                                <li>
                                  <a href="{{env('APP_URL')}}/miubicacion">
                                      <i class="metismenu-icon pe-7s-map-marker"></i>
                                      Mi Ubicación
                                  </a>
                                </li>
                                
                                <li>
                                  <form id="logout-form" action="{{ url('logout') }}" method="POST">
                            				{{ csrf_field() }}
                                    <button class="btn btn-danger" type="submit" name="button">
                                        <i class="metismenu-icon pe-7s-back-2"></i>Salir
                                    </button>
                									</form>

                                </li>
                                <!-- Fin titulo menu -->

                            </ul>
                        </div>
                    </div>
                </div>


                <p align="center"><img src="{{ asset('public/images/logo100x100.png')}}" alt=""></p>
                <div class="app-main__outer">
                    @yield('content')
                </div>


        </div>
    </div>
<script type="text/javascript" src="{{ asset('public/scripts/main.js') }}"></script>


<!-- NOTIFICACIONES -->

<script type="text/javascript">
	messaging.onMessage(function(payload){
			console.log('onMessage Layout:', payload);
			Swal.fire(payload.notification.body);
			/*alert(payload.notification.body);*/
								const noteTitle = payload.notification.title;
                const noteOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(noteTitle, noteOptions);
		});
</script>

<!-- notificaciones -->
<script type="text/javascript">
	messaging.onMessage(function(payload){
			console.log('onMessage Layout:', payload);
			Swal.fire(payload.notification.body);

			/*alert(payload.notification.body);*/

								const noteTitle = payload.notification.title;
                const noteOptions = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(noteTitle, noteOptions);
		});
</script>



</body>
</html>
