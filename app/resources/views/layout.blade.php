@php
$rol=2;
	$user = auth()->user();
	if($user){
		$rol=$user->rol;
	}
/*
if($rol=='1'){
	header("Location: /admindash/");
	exit;
}
*/
@endphp
<!doctype html>
<html class="no-js" lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>PídemeOnLine | La manera más cómoda de hacer tus pedidos</title>
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
 <script src="{{ asset ('public/js/sweetalert2.all.js')}}"></script>
 <script src="{{ asset ('public/js/vendor/jquery-3.2.1.min.js')}}"></script>
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
                                <a href="{{env('APP_URL')}}">
                                    <img src="{{ asset ('public/images/logo/logo100x100.png') }}" alt="logo images">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-sm-4 col-md-2 order-3 order-lg-2">
                            <div class="main__menu__wrap">
                                <nav class="main__menu__nav d-none d-lg-block">
                                    <ul class="mainmenu">
                                        <li class="drop"><a href="{{env('APP_URL')}}">Inicio</a></li>
                                        <!--<li><a href="{{env('APP_URL')}}/about">Nosotros</a></li>-->
																				<li><a href="{{env('APP_URL')}}/negocios">Afiliados</a></li>
																				<!--<li><a href="{{env('APP_URL')}}/categorias">Categorias</a></li>-->
                                        <!--<li><a href="{{env('APP_URL')}}/contacto">Contacto</a></li>-->
																				<li><a href="{{env('APP_URL')}}/carrito">
																					<i class="zmdi zmdi-shopping-cart" style="color:red;"></i> Carrito</a>
																				</li>
																				<li>
																					<a href="{{env('APP_URL')}}/pedidos">
																						<i class="zmdi zmdi-money-box" style="color:red;"></i> En curso
																					</a>
																				</li>
																				<li>
																				<a href="{{env('APP_URL')}}/historicos">
																					<i class="zmdi zmdi-archive" style="color:red;"></i> Historial</a>
																				</a>
																			</li>
																			<li>
																			<a href="{{env('APP_URL')}}/perfil">
																				<i class="zmdi zmdi-account" style="color:red;"></i> Perfil</a>
																			</a>
																		</li>
																			@if($rol=='1')
																			<li>
																			<a href="/admindash">
																				<i class="zmdi zmdi-archive" style="color:red;"></i> Admin</a>
																			</a>
																		</li>
																			@endif
                                    </ul>
                                </nav>
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
                                <div class="shopping__cart">
                                    <a class="minicart-trigger" href="#"><i class="zmdi zmdi-shopping-cart"></i></a>
                                    <div class="shop__qun">
																			@if(isset($num))
                                        <span>{{$num}}</span>
																			@endif
                                    </div>
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
                        <!-- Start Single Footer -->
												<!--
                        <div class="col-md-6 col-lg-3 col-sm-12 sm--mt--40">
                            <div class="footer gallery">
                                <h2 class="ftr__title">Misión</h2>
                                Nuestra misión es implementar una plataforma innovadora que, a través de la Internet y el marketing digital, impulse los productos y servicios que ofrecen las empresas regionales, y les permita el uso de nuevas herramientas tecnológicas de comunicación e información para realizar sus operaciones comerciales.
                            </div>
                        </div>
											-->
                        <!-- End Single Footer -->
                        <!-- Start Single Footer -->
												<!--
                        <div class="col-md-6 col-lg-3 col-sm-12 md--mt--40 sm--mt--40">
                            <div class="footer">
                                <h2 class="ftr__title">Visión</h2>
																Convertirnos en la más grande plataforma de comercio online del país, proporcionándole a empresas y consumidores las más modernas herramientas tecnológicas para realizar sus operaciones comerciales de manera fácil y rápida.
                            </div>
                        </div>
											-->
                        <!-- End Single Footer -->
                        <!-- Start Single Footer -->
												<!--
                        <div class="col-md-6 col-lg-3 col-sm-12 md--mt--40 sm--mt--40">
                            <div class="footer">
                                <h2 class="ftr__title">Beneficios</h2>
                                <div class="footer__inner">

                                </div>
                            </div>
                        </div>
											-->
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
												<h1><i class="zmdi zmdi-account"></i> {{Auth::user()->name}}</h1>
        									<form id="logout-form" action="{{ url('logout') }}" method="POST">
                    				{{ csrf_field() }}
            								<button class="btn btn-warning">Cerrar Sesión</button>
        									</form>
													<a class="btn btn-danger" href="{{env('APP_URL')}}/change-password">
                  					Cambiar Password
                					</a>
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
                                <input class="cr-round--lg" id="name" type="text" placeholder="Nombre y Apellido" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
																@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
														<div class="single-input">
                                <input class="cr-round--lg" id="cedula" type="text" placeholder="Nro. Cédula" name="cedula" value="{{ old('cedula') }}" required autocomplete="cedula" autofocus pattern="[0-9]{8}">
																@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
														<div class="single-input">
                                <input class="cr-round--lg" id="telefono" type="text" placeholder="Teléfono" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus pattern="[0-9]{11}">
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


				<!-- Cartbox Carrito-->
        <div class="cartbox-wrap">
					@if(isset($carritos))
            <div class="cartbox text-right">
                <button class="cartbox-close"><i class="zmdi zmdi-close"></i></button>
                <div class="cartbox__inner text-left">
                    <div class="cartbox__items">
                        <!-- Cartbox Single Item -->
												@php $moneda=""; $TOTALcomplementos=0; @endphp
												@foreach($carritos as $row)
												@php $moneda=$row->moneda; @endphp
                        <div class="cartbox__item">
                            <div class="cartbox__item__thumb">
                                <a>
                                    <img src="/deliverydash/public/storage/app/public/uploads/{{$row->foto}}" alt="list food images">
                                </a>
                            </div>
                            <div class="cartbox__item__content">
                                <h5><a class="product-name">{{$row->nombre}}</a></h5>
                                <p>Cant: <span>{{$row->cantidad}}</span></p>
                                <span class="price">{{$row->moneda}} {{$row->precio}}</span>
																<!-- COMPLEMENTOS -->
																@if(isset($complementos))
																<div class="">
																	@php $totalcomplementos=0; @endphp
																	@foreach($complementos as $complemento)
																		@if($complemento->carrito==$row->id)
																		<form action="{{ route('complementos.destroy',$complemento->id) }}" method="POST">
																			@csrf
																			@method('DELETE')
																			<button type="submit" class="btn btn-danger py-0 px-1" style="font-size: 0.7em;">
																					x
																			</button>
																			<font color="black" size="1">{{$complemento->nombre}}</font> - <font color="red" size=1>{{$complemento->moneda}} {{$complemento->precio}}</font><hr>
																			@php $totalcomplementos=$totalcomplementos+$complemento->precio; @endphp
																		</form>
																		@endif
																	@endforeach
																</div>
																@endif
																<!-- fin complementos -->
																@if($row->cantidad>0)
																	<p>Total: <span>{{$moneda}}
																		@php
																			$subtotal=($row->precio+$totalcomplementos)*$row->cantidad;
																			$TOTALcomplementos=$TOTALcomplementos+$subtotal;
																			echo $subtotal;
																		@endphp
																	 </span></p>
																@endif
                            </div>
														<form action="{{ route('carritos.destroy',$row->id) }}" method="POST">
															@csrf
                            	@method('DELETE')
															<button type="submit" class="cartbox__item__remove">
																	<i class="zmdi zmdi-delete"></i>
															</button>
														</form>
                        </div><!-- //Cartbox Single Item -->
												@endforeach
												<!-- Cartbox Single Item -->

                        <!-- Cartbox Single Item -->

                    </div>
                    <div class="cartbox__total">
                        <ul>
                            <!--<li><span class="cartbox__total__title">Subtotal</span><span class="price">{{$moneda}} </span></li>-->
                            <!--<li class="shipping-charge"><span class="cartbox__total__title">Shipping Charge</span><span class="price">$05</span></li>-->
                            <li class="grandtotal">Total<span class="price">{{$moneda}} {{$TOTALcomplementos}}</span></li>
                        </ul>
                    </div>
                    <div class="cartbox__buttons">
                        <!--<a class="food__btn" href="cart.html"><span>View cart</span></a>-->
                        <a class="food__btn" href="{{env('APP_URL')}}/carrito"><span>Ver Carrito</span></a>
												<a href="{{env('APP_URL')}}/carrito/vaciar">
													<button class="btn btn-dark btn-block">VACIAR TODO EL CARRITO</button>
												</a>
                    </div>
                </div>
            </div>
					@else
					<div class="cartbox text-right">
							<button class="cartbox-close"><i class="zmdi zmdi-close"></i></button>
							<div class="cartbox__inner text-left">
								No hay elementos en el carrito
							</div>
					</div>
					@endif
				</div>
				<!-- //Cartbox -->

    </div><!-- //Main wrapper -->

    <!-- JS Files -->
    
    <script src="{{ asset ('public/js/popper.min.js')}}"></script>
    <script src="{{ asset ('public/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset ('public/js/plugins.js')}}"></script>
    <script src="{{ asset ('public/js/active.js')}}"></script>


</body>

<!-- NOTIFICACIONES -->

<script type="text/javascript">
	messaging.onMessage(function(payload){
			console.log('onMessage Layout:', payload);
			Swal.fire(payload.notification.body);

//			Website2APK.showToast(payload.notification.body);

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

</html>
