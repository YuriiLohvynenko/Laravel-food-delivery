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
/*
Route::get('/', function () {
    return view('inicio');
});
*/

Auth::routes();
Route::get('/','InicioController@index')->middleware('auth');

Route::get('noautorizado',function(){
    return view('noautorizado');
});

Route::resource('negocios','NegocioController')->middleware('auth');

Route::get('ubicaciones','NegocioController@ubicaciones')->middleware('auth');

Route::resource('menus','MenuController')->middleware('auth');
Route::get('menu/{id}','MenuController@mostrar')->middleware('auth');

Route::resource('metodos','MetodoController')->middleware('auth');

Route::resource('adicionales','AdicionalController')->middleware('auth');
Route::get('adicional/{id}/modificar','AdicionalController@modificar')->middleware('auth');
Route::post('adicional/disponible','AdicionalController@disponible')->middleware('auth');

Route::resource('zonas','ZonaController')->middleware('auth');

Route::resource('tarifas','TarifaController')->middleware('auth');

Route::get('miubicacion', function(){
  return view('negocios.miubicacion');
});

Route::resource('pedidos','PedidoController')->middleware('auth');
Route::any('comprobante','PedidoController@comprobante')->middleware('auth');
Route::get('historico','PedidoController@historico')->middleware('auth');
Route::any('pedido/mostrar','PedidoController@mostrar')->middleware('auth');
Route::get('reporte','PedidoController@reporte')->middleware('auth');
Route::post('buscar','PedidoController@buscar')->middleware('auth');
Route::get('getavailorder','PedidoController@getavailorder')->middleware('auth');

Route::any('/pedidos/update/{id}','PedidoController@update')->middleware('auth');

Route::resource('chats','ChatController')->middleware('auth');
Route::post('salachat','ChatController@sala')->middleware('auth');
Route::post('iniciarchat','ChatController@iniciar')->middleware('auth');
Route::post('enviarchat','ChatController@guardar')->middleware('auth');

Route::resource('valoraciones','ValoracionController')->middleware('auth');
Route::post('valorar','ValoracionController@valorar')->middleware('auth');

Route::resource('choferes','ChoferController')->middleware('auth');

Route::resource('envios','EnvioController')->middleware('auth');
Route::post('reportechofer','EnvioController@reporte')->middleware('auth');
Route::post('buscarenvios','EnvioController@buscar')->middleware('auth');


Route::get('notificaciones',function(){
    return view('notificaciones');
});

Route::post('notificaciones','InicioController@activar')->middleware('auth');
