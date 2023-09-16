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

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login','Auth\LoginController@login')->name('login');
Route::get('/','Auth\LoginController@show')->name('showlogin');
Route::post('/logout','Auth\LoginController@logOut')->name('logout');

Route::group(['middleware' => ['auth']], function(){
	Route::get('/home', 'HomeController@index')->name('home');

	//rutas usuarios
	Route::get('/user', 'UserController@index')->name('user.index');
	Route::get('/user/new', 'UserController@create')->name('user.new');
	Route::post('/user/new/save', 'UserController@store')->name('user.store');
	Route::put('/user/desactivar/{id}','UserController@deactivate')->name('user.deactive');
	Route::put('/user/activar/{id}','UserController@activate')->name('user.active');
	Route::get('/user/actualizar/{id}','UserController@edit')->name('user.edit');
	Route::put('/user/Actualizar/{id}','UserController@update')->name('user.update');
	Route::put('/user/eliminar/{id}','UserController@delete')->name('user.delete');

	//rutas de responsables
	Route::get('responsible', 'ResponsibleController@index')->name('responsible.index');
	Route::get('/responsible/new', 'ResponsibleController@create')->name('responsible.new');
	Route::post('/responsible/new/save', 'ResponsibleController@store')->name('responsible.store');
	Route::put('/responsible/desactivar/{id}','ResponsibleController@deactivate')->name('responsible.deactive');
	Route::put('/responsible/activar/{id}','ResponsibleController@activate')->name('user.active');
	Route::get('/responsible/actualizar/{id}','ResponsibleController@edit')->name('responsible.edit');
	Route::put('/responsible/Actualizar/{id}','ResponsibleController@update')->name('responsible.update');
	Route::put('/responsible/eliminar/{id}','ResponsibleController@delete')->name('responsible.delete');

	//rutas de entrenadores
	Route::get('Entrenador', 'CoachController@index')->name('coach.index');
	Route::get('/Entrenador/new', 'CoachController@create')->name('coach.new');
	Route::post('/Entrenador/new/save', 'CoachController@store')->name('coach.store');
	Route::put('/Entrenador/desactivar/{id}','CoachController@deactivate')->name('coach.deactive');
	Route::put('/Entrenador/activar/{id}','CoachController@activate')->name('coach.active');
	Route::get('/Entrenador/actualizar/{id}','CoachController@edit')->name('coach.edit');
	Route::put('/Entrenador/Actualizar/{id}','CoachController@update')->name('coach.update');
	Route::put('/Entrenador/eliminar/{id}','CoachController@delete')->name('coach.delete');


	// rutas para clientes
	Route::get('/customer', 'CustomerController@index')->name('customer.index');
	Route::get('/customer/new', 'CustomerController@create')->name('customer.new');
	Route::post('/customer/new/save', 'CustomerController@store')->name('customer.store');
	Route::put('/customer/desactivar/{id}','CustomerController@deactivate')->name('customer.deactive');
	Route::put('/customer/activar/{id}','CustomerController@activate')->name('customer.active');
	Route::get('/customer/actualizar/{id}','CustomerController@edit')->name('customer.edit');
	Route::put('/customer/eliminar/{id}','CustomerController@delete')->name('customer.delete');
	Route::put('/customer/Actualizar/{id}','CustomerController@update')->name('customer.update');

	// rutasde categorias
	Route::get('/categoria', 'CategoryController@index')->name('category.index');
	Route::post('/categoria/save', 'CategoryController@store')->name('category.store');
	Route::put('/categoria/desactivar/{id}','CategoryController@deactivate')->name('category.deactive');
	Route::put('/categoria/activar/{id}','CategoryController@activate')->name('category.active');
	Route::put('/categoria/eliminar/{id}','CategoryController@delete')->name('category.delete');
	Route::put('/categoria/Actualizar/{id}','CategoryController@update')->name('category.update');

	// rutas de tipos de producto
	Route::get('Tipo-de-producto', 'ProductTypeController@index')->name('productType.index');
	Route::post('/Tipo-de-producto/save', 'ProductTypeController@store')->name('productType.store');
	Route::put('/Tipo-de-producto/desactivar/{id}','ProductTypeController@deactivate')->name('productType.deactive');
	Route::put('/Tipo-de-producto/activar/{id}','ProductTypeController@activate')->name('productType.active');
	Route::put('/Tipo-de-producto/eliminar/{id}','ProductTypeController@delete')->name('productType.delete');
	Route::put('/Tipo-de-producto/Actualizar/{id}','ProductTypeController@update')->name('productType.update');

	//rutas para productos
	Route::get('Producto', 'ProductController@index')->name('product.index');
	Route::get('/Producto/new', 'ProductController@create')->name('product.new');

	// rutas actividades y promociones
	Route::get('Actividades-y-promociones', 'PromotionController@index')->name('promotion.index');
	Route::post('/Actividades-y-promociones/save', 'PromotionController@store')->name('promotion.store');
	Route::put('/Actividades-y-promociones/desactivar/{id}','PromotionController@deactivate')->name('promotion.deactive');
	Route::put('/Actividades-y-promociones/activar/{id}','PromotionController@activate')->name('promotion.active');
	Route::put('/Actividades-y-promociones/eliminar/{id}','PromotionController@delete')->name('promotion.delete');
	Route::put('/Actividades-y-promociones/Actualizar/{id}','PromotionController@update')->name('promotion.update');

	// rutas espacios deportivos
	Route::get('Espacios-Deportivos', 'SpaceController@index')->name('space.index');
	Route::post('/Espacios-Deportivos/save', 'SpaceController@store')->name('space.store');
	Route::put('/Espacios-Deportivos/desactivar/{id}','SpaceController@deactivate')->name('space.deactive');
	Route::put('/Espacios-Deportivos/activar/{id}','SpaceController@activate')->name('space.active');
	Route::put('/Espacios-Deportivos/eliminar/{id}','SpaceController@delete')->name('space.delete');
	Route::put('/Espacios-Deportivos/Actualizar/{id}','SpaceController@update')->name('space.update');

	Route::get('/reservas', 'ReservationController@index')->name('reservation.index');

	// rutas deportes
	Route::get('Deportes', 'SportController@index')->name('sport.index');
	Route::post('/Deportes/save', 'SportController@store')->name('sport.store');
	Route::put('/Deportes/desactivar/{id}','SportController@deactivate')->name('sport.deactive');
	Route::put('/Deportes/activar/{id}','SportController@activate')->name('sport.active');
	Route::put('/Deportes/eliminar/{id}','SportController@delete')->name('sport.delete');
	Route::put('/Deportes/Actualizar/{id}','SportController@update')->name('sport.update');
	// rutas equipos
	Route::get('Equipos', 'TeamController@index')->name('team.index');
	Route::post('/Equipos/save', 'TeamController@store')->name('team.store');
	Route::put('/Equipos/desactivar/{id}','TeamController@deactivate')->name('team.deactive');
	Route::put('/Equipos/activar/{id}','TeamController@activate')->name('team.active');
	Route::put('/Equipos/eliminar/{id}','TeamController@delete')->name('team.delete');
	Route::put('/Equipos/Actualizar/{id}','TeamController@update')->name('team.update');

	//rutas ventas
	Route::get('Venta', 'SalesController@index')->name('sale.index');
});