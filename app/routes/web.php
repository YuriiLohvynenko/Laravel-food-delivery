<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'CategoriaController@welcome');

Route::get('inicio', function () {
    return view('inicio');
});



Route::get('sinconexion', function () {
    return view('sinconexion');
});


Route::get('about', function () {
    return view('about');
});

Route::get('contacto', function () {
    return view('contacto');
});

Route::resource('categorias','CategoriaController');

Route::resource('negocios','NegocioController');
Route::get('negocioscat/{id}','NegocioController@mostrar');
Route::get('detalle/{id}','NegocioController@detalle');
Route::post('negocios/buscar','NegocioController@buscar');

Route::resource('menus','MenuController');
Route::get('menu/{id}','MenuController@mostrar');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::post('registro', 'RegisterController@store');
//Route::post('/entrar', 'LoginController@store');
Route::post('post-login', 'AuthController@postLogin');

Route::resource('carritos','CarritoController')->middleware('auth');
Route::get('carrito','CarritoController@ver')->middleware('auth');
Route::get('carrito/vaciar','CarritoController@vaciar')->middleware('auth');

Route::resource('complementos','ComplementoController')->middleware('auth');
//Route::get('eliminarcomplemento/{id}','ComplementoController@eliminar');

Route::get('adicionales/{id}','ComplementoController@agregar')->middleware('auth');
Route::post('adicionales/agregarvarios','ComplementoController@agregarvarios')->middleware('auth');

Route::resource('pedidos','PedidoController')->middleware('auth');
Route::get('pedido/{id}/pagar','PedidoController@pagar')->middleware('auth');
Route::post('pedido/comprobante','PedidoController@comprobante')->middleware('auth');
Route::get('historicos','PedidoController@historicos')->middleware('auth');
Route::post('pedido/mostrar','PedidoController@mostrar')->middleware('auth');
Route::post('vercomprobante','PedidoController@vercomprobante')->middleware('auth');
Route::get('prueba','PedidoController@prueba')->middleware('auth');
Route::any('/pedidos/update/{id}','PedidoController@update')->middleware('auth');


Route::resource('chats','ChatController')->middleware('auth');
Route::post('salachat','ChatController@sala')->middleware('auth');
Route::post('iniciarchat','ChatController@iniciar')->middleware('auth');
Route::post('enviarchat','ChatController@guardar')->middleware('auth');

//cambio de contraseña
Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

//notificaciones
Route::post('enviar','MensajeController@sendPush');

Route::resource('valoraciones','ValoracionController')->middleware('auth');

Route::resource('perfil','UsuarioController')->middleware('auth');
Route::post('foto','UsuarioController@foto')->middleware('auth');
Route::get('view_delivery/{id}','PedidoController@view_delivery')->middleware('auth');
Route::get('getdelivery','PedidoController@getdelivery')->middleware('auth');
Route::get('getuserorder','PedidoController@getuserorder')->middleware('auth');