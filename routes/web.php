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
	Route::get('/Tipo-de-producto/{id}', 'ProductTypeController@detLinea')->name('productType.detail');
	Route::post('/Tipo-de-producto/add-etapa', 'ProductTypeController@addetapa');
	Route::delete('/Tipo-de-producto/elimiprocs/{id}', 'ProductTypeController@elimpro');
	Route::get('/Tipo-de-producto/asignacion/{id}', 'ProductTypeController@detAsig')->name('productType.asignation');
	Route::post('/Tipo-de-producto/asignacion/save', 'ProductTypeController@addproduct');
	Route::delete('/Tipo-de-producto/asignacion/elimiprod/{id}', 'ProductTypeController@elimproduct');

	//rutas para productos
	Route::get('Producto', 'ProductController@index')->name('product.index');
	Route::get('/Producto/new', 'ProductController@create')->name('product.new');

	// rutas actividades y promociones
	Route::get('Tareas', 'PromotionController@index')->name('promotion.index');
	Route::post('/Tareas/save', 'PromotionController@store')->name('promotion.store');
	Route::put('/Tareas/desactivar/{id}','PromotionController@deactivate')->name('promotion.deactive');
	Route::put('/Tareas/activar/{id}','PromotionController@activate')->name('promotion.active');
	Route::put('/Tareas/eliminar/{id}','PromotionController@delete')->name('promotion.delete');
	Route::put('/Tareas/Actualizar/{id}','PromotionController@update')->name('promotion.update');

	// rutas espacios deportivos
	Route::get('Espacios-Deportivos', 'SpaceController@index')->name('space.index');
	Route::post('/Espacios-Deportivos/save', 'SpaceController@store')->name('space.store');
	Route::put('/Espacios-Deportivos/desactivar/{id}','SpaceController@deactivate')->name('space.deactive');
	Route::put('/Espacios-Deportivos/activar/{id}','SpaceController@activate')->name('space.active');
	Route::put('/Espacios-Deportivos/eliminar/{id}','SpaceController@delete')->name('space.delete');
	Route::put('/Espacios-Deportivos/Actualizar/{id}','SpaceController@update')->name('space.update');

	Route::get('/reservas', 'ReservationController@index')->name('reservation.index');

	// rutas deportes
	Route::get('Unidad', 'SportController@index')->name('sport.index');
	Route::post('/Unidad/save', 'SportController@store')->name('sport.store');
	Route::put('/Unidad/desactivar/{id}','SportController@deactivate')->name('sport.deactive');
	Route::put('/Unidad/activar/{id}','SportController@activate')->name('sport.active');
	Route::put('/Unidad/eliminar/{id}','SportController@delete')->name('sport.delete');
	Route::put('/Unidad/Actualizar/{id}','SportController@update')->name('sport.update');
	// rutas almacenes
	Route::get('Almacenes', 'AlmacenController@index')->name('almacen.index');
	Route::post('/Almacenes/save', 'AlmacenController@store')->name('almacen.store');
	Route::put('/Almacenes/desactivar/{id}','AlmacenController@deactivate')->name('almacen.deactive');
	Route::put('/Almacenes/activar/{id}','AlmacenController@activate')->name('almacen.active');
	Route::put('/Almacenes/eliminar/{id}','AlmacenController@delete')->name('almacen.delete');
	Route::put('/Almacenes/Actualizar/{id}','AlmacenController@update')->name('almacen.update');

	// rutas equipos
	Route::get('Actividades', 'TeamController@index')->name('team.index');
	Route::post('/Actividades/save', 'TeamController@store')->name('team.store');
	Route::put('/Actividades/desactivar/{id}','TeamController@deactivate')->name('team.deactive');
	Route::put('/Actividades/activar/{id}','TeamController@activate')->name('team.active');
	Route::put('/Actividades/eliminar/{id}','TeamController@delete')->name('team.delete');
	Route::put('/Actividades/Actualizar/{id}','TeamController@update')->name('team.update');

	//rutas ventas
	Route::get('Venta', 'SalesController@index')->name('sale.index');
	// rutas Distribucion
	Route::get('Distribucion', 'DistributionController@index')->name('distribucion.index');
	Route::get('/Distribucion/{id}', 'DistributionController@newped')->name('distribucion.unidad');
	Route::post('/Distribucion/save/', 'DistributionController@store')->name('distribucion.store');
	Route::get('/Distribucion/Detalle/{id}', 'DistributionController@detped')->name('distribucion.detpedido');
	Route::post('/Distribucion/savedet/', 'DistributionController@storedet')->name('distribucion.storedet');
	Route::put('/Distribucion/confirm/','DistributionController@activate')->name('distribucion.active');
	Route::put('/Distribucion/cancel/','DistributionController@cancelar')->name('distribucion.cancel');
	Route::put('/Distribucion/Actualizar/{id}/{pedido}','DistributionController@update')->name('almacen.update');
	// administracion de pedidos-distribucion
	Route::get('AdminDistribucion', 'DistributionController@indexadm')->name('distribucion.indexadm');
	Route::get('/AdminDistribucion/{id}', 'DistributionController@admped')->name('distribucion.pedidosadm');
	Route::get('/AdminDistribucion/Detalle/{id}', 'DistributionController@admdetped')->name('distribucion.detpedidoadm');
	Route::put('/AdminDistribucion/confirm/','DistributionController@atender')->name('distribucion.atencion');
	Route::put('/AdminDistribucion/Actualizar/{id}/{pedido}','DistributionController@updateadm')->name('almacen.update');
	//pedidos institucionales
	Route::get('Institucional','DistributionController@indexi')->name('institucion.index');
	Route::get('/Institucional/{id}', 'DistributionController@newlic')->name('institucion.unidad');
	Route::post('/Institucional/save/', 'DistributionController@storei')->name('institucion.store');
	Route::get('/Institucional/Detalle/{id}', 'DistributionController@detinsa')->name('institucion.detpedido');
	Route::post('/Institucional/savedet/', 'DistributionController@storedeti')->name('distribucion.storedet');
	//administracion instituciones
	Route::get('AdminInsti', 'DistributionController@indexadmins')->name('institucion.indexadm');
	Route::get('/AdminInsti/{id}', 'DistributionController@admpedins')->name('institucion.lisiadm');
	Route::get('/AdminInsti/Detalle/{id}', 'DistributionController@admdetpedins')->name('institucion.detlisiadm');
	Route::put('/AdminInsti/confirm/','DistributionController@atenderins')->name('institucion.atencion');
	Route::put('/AdminInsti/Actualizar/{id}/{pedido}','DistributionController@updateins')->name('institucion.update');
	//aprobacion de instituciones
	Route::get('ComInsti', 'DistributionController@indexapro')->name('institucion.indexapro');
	Route::get('/ComInsti/{id}', 'DistributionController@admlistapro')->name('institucion.lisiadm');
	Route::get('/ComInsti/Detalle/{id}', 'DistributionController@admdetapro')->name('institucion.detlisiadm');
	Route::put('/ComInsti/confirm/','DistributionController@confapro')->name('institucion.atencion');
	Route::put('/ComInsti/confirmre/','DistributionController@confrech')->name('institucion.rechazar');
	Route::put('/ComInsti/Actualizar/{id}/{pedido}','DistributionController@updateins')->name('institucion.update');
	//asignacion de unidades de negocio
	Route::get('Config', 'DistributionController@indexconf')->name('config.index');
	Route::get('/Config/{id}', 'DistributionController@asiguneg')->name('config.asignation');
	Route::post('/Config/asignacion/save', 'DistributionController@addunit');
	Route::delete('/Config/asignacion/elimiuneg/{id}', 'DistributionController@elimuni');


	// rutas de ordenes de produccion
	Route::get('Orden-produccion', 'OrderController@index')->name('order.index');
	Route::post('/Orden-produccion/save', 'OrderController@store')->name('order.store');
	
	Route::get('prom/{id}','OrderController@proemlot');
	Route::post('generate-lote', 'OrderController@generate');

	Route::get('Seguimiento-produccion', 'OrderController@indexseg')->name('seguimiento.index');
	Route::get('/Seguimiento-produccion/{id}', 'OrderController@detSeg')->name('seguimiento.detail');
	Route::put('/Seguimiento-produccion/fin/{id}','OrderController@confimstate')->name('seguimiento.active');

	Route::get('Reportes', 'OrderController@indexrep')->name('report.index');
	Route::get('/reporte/{ini}/{end}','OrderController@report')->name('report.det');
	Route::get('/reporte/pdf/{ini}/{fin}', 'OrderController@exportPdf')->name('report.pdf');

});