<!doctype html>
<html class="no-js" lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>PídemeOnLine | La manera más rápida de hacer tus pedidos</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="{{ asset('public/images/logo/logo100x100.png')}}">
	<link rel="apple-touch-icon" href="{{ asset ('public/images/logo/logo.png')}}">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset ('public/css/bootstrap.min.css') }} ">
	<link rel="stylesheet" href="{{ asset ('public/css/plugins.css') }}">
	<link rel="stylesheet" href="{{ asset ('public/style.css') }}">
	<link rel="stylesheet" href="{{ asset ('public/custom.css') }}">

	<!-- Cusom css -->
 <link rel="stylesheet" href="{{ asset ('public/css/custom.css') }}">
 <!--<script src="https://kit.fontawesome.com/11391dc641.js" crossorigin="anonymous"></script>-->

 <!-- Modernizer js -->
 <script src="{{ asset ('public/js/vendor/modernizr-3.5.0.min.js')}}"></script>

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
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Add your site or application content here -->

	<!-- <div class="fakeloader"></div> -->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Start Header Area -->
        <header class="htc__header bg--white">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-sm-4 col-md-6 order-1 order-lg-1">
                            <div class="logo">
                                <a>
                                    <img src="{{ asset ('public/images/logo/logo100x100.png') }}" alt="logo images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3">
                            <div class="header__right d-flex justify-content-end">
                                <div class="log__in">
                                    <a class="accountbox-trigger" href="#">
																			<i class="zmdi zmdi-account-o"> </i>
																				@if(Auth::check())
																					{{ substr(Auth::user()->name,0,strpos(Auth::user()->name," ")) }}
																				@else
																					Ingresar
																				@endif
																		</a>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="mobile-menu d-block d-lg-none"></div>
                    <!-- Mobile Menu -->
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->


				@yield('content')





				<!-- Start Footer Area -->
        <footer class="footer__area footer--1">
            <div class="footer__wrapper bg__cat--1 section-padding--lg">
                <div class="container">
                    <div class="row">
                        <!-- Start Single Footer -->
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <div class="footer">
                                <h2 class="ftr__title">Sobre Nosotros</h2>
                                <div class="footer__inner">
                                    <div class="ftr__details">
                                        <img src="{{ asset('public/images/logo/logo.png')}}" class="image-responsive" width="50%">
                                        <div class="ftr__address__inner">
                                            <div class="ftr__address">
                                                <div class="ftr__address__icon">
                                                    <i class="zmdi zmdi-home"></i>
                                                </div>
                                                <div class="frt__address__details">
                                                    <p>Puerto Ordaz. Edo. Bolívar</p>
                                                </div>
                                            </div>
                                            <div class="ftr__address">
                                                <div class="ftr__address__icon">
                                                    <i class="zmdi zmdi-phone"></i>
                                                </div>
                                                <div class="frt__address__details">
                                                    <p><a href="https://api.whatsapp.com/send?phone=584249748585&text=Hola,%20necesito%20informaci%C3%B3n">+58 4249748585</a></p>

                                                </div>
                                            </div>
                                            <div class="ftr__address">
                                                <div class="ftr__address__icon">
                                                    <i class="zmdi zmdi-email"></i>
                                                </div>
                                                <div class="frt__address__details">
                                                    <p><a href="mailto:ventaspidemeonline@gmail.com">ventaspidemeonline@gmail.com</a></p>
                                                </div>
                                            </div>
                                        </div>
																				<ul class="social__icon">
                                            <li><a href="https://facebook.com/pidemeonline/" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                                            <!--<li><a href="#"><i class="zmdi zmdi-google"></i></a></li>-->
                                            <li><a href="https://instagram.com/pidemeonline/" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
																						<li><a href="https://twitter.com/pidemeonline/" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer -->


                    </div>
                </div>
            </div>
            <div class="copyright bg--theme">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="copyright__inner">
                                <div class="cpy__right--left">
                                    <p>@Derechos Reservados.</p>
                                </div>
                                <div class="cpy__right--right">
                                    <a href="#">
                                        <img src="{{asset('public/images/icon/shape/2.png')}}" alt="payment images">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->
        <!-- Login Form -->
        <div class="accountbox-wrapper">
            <div class="accountbox text-left">
                <ul class="nav accountbox__filters" id="myTab" role="tablist">
								@if(Auth::check())
								<h3>Cerrar Sesión</h3>
								@else
                    <li>
                        <a class="active" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="true">Ingresa</a>
										</li>
										<li>
                        <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Regístrate Aquí!</a>
                    </li>
								@endif
                </ul>
                <div class="accountbox__inner tab-content" id="myTabContent">
                    <div class="accountbox__login tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="log-tab">
											@if(Auth::check())
												<h1><i class="zmdi zmdi-account-o"></i> {{Auth::user()->name}}</h1>
        									<form id="logout-form" action="{{ url('logout') }}" method="POST">
                    				{{ csrf_field() }}
            								<button class="btn btn-warning">Cerrar Sesión</button>
        									</form>
											@else
												<!--<form method="POST" action="{{ route('login') }}">-->
												<form action="{{url('post-login')}}" method="POST" id="logForm">
													@csrf
                            <div class="single-input">
                                <input id="email1" class="cr-round--lg" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="single-input">
                                <input id="password1" class="cr-round--lg" type="password" placeholder="Password" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="single-input">
                                <button type="submit" class="food__btn"><span>Ingresar</span></button>
																@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Olvidaste tu contraseña?') }}
                                    </a>

                                @endif
                            </div>
                        </form>
											@endif
                    </div>
                    <div class="accountbox__register tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<!--<form method="POST" action="registro">-->
											<form method="POST" action="{{ route('register') }}">
                        @csrf
                            <div class="single-input">
                                <input class="cr-round--lg" id="name" type="text" placeholder="Nombre" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
																@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
														<div class="single-input">
                                <input class="cr-round--lg" id="telefono" type="text" placeholder="Teléfono" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>
																@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="single-input">
                                <input id="email" class="cr-round--lg" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
																@error('email')
																	<span class="invalid-feedback" role="alert">
																		<strong>{{ $message }}</strong>
																	</span>
																@enderror
                            </div>
                            <div class="single-input">
                                <input id="password" class="cr-round--lg" type="password" placeholder="Contraseña" name="password" required autocomplete="new-password">
                            </div>
                            <div class="single-input">
																<input id="password-confirm" class="cr-round--lg" type="password" placeholder="Confirma contraseña" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="single-input">
                                <button type="submit" class="food__btn"><span>Registarse</span></button>
                            </div>
                        </form>
                    </div>
                    <span class="accountbox-close-button"><i class="zmdi zmdi-close"></i></span>
                </div>
            </div>
        </div>
				<!-- //Login Form -->




    </div><!-- //Main wrapper -->

    <!-- JS Files -->
    <script src="{{ asset ('public/js/vendor/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset ('public/js/popper.min.js')}}"></script>
    <script src="{{ asset ('public/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset ('public/js/plugins.js')}}"></script>
    <script src="{{ asset ('public/js/active.js')}}"></script>

		<!-- NOTIFICACIONES -->

		<script type="text/javascript">
		messaging.onMessage(function(payload){
		console.log('onMessage Layout:', payload);
		alert(payload.notification.body);

		});
		</script>

		<!-- notificaciones -->
</body>


</html>
