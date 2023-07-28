<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InventarioController;

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

//Route::get('/', function () { return view('login'); });

Auth::routes();

// Ruta a Login AdminLTE directo
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Ruta a Nueva vitrina virtual
// Route::get('/', function () { return view('vitrina.index');});
// Route::get('/inicio', function () { return view('vitrina.index');});
// Route::get('/info', function () { return view('vitrina.info');});
// Route::get('/lista', function () { return view('vitrina.lista');});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('page_home');
Route::resource('/home','App\Http\Controllers\HomeController');
Route::get('/',[PageController::class,'index']);
Route::get('inicio',[PageController::class,'index'])->name('inicio');
Route::get('info',[PageController::class,'info'])->name('info');
Route::get('lista', [PageController::class,'lista'])->name('lista');
Route::get('categories', [PageController::class,'porcat'])->name('categories');
Route::get('detalle/producto/{id}', [PageController::class,'producto'])->name('detalle');
//Busqueda de producto
Route::any('/buscar',[PageController::class,'buscar']);
//Route::get('/home', function () { return view('home');});

Route::resource('productos','App\Http\Controllers\ProductoController')->except('show');
Route::get('productos/reporte/{id}',[ProductoController::class,'reporte'])->middleware('auth')->name('generar_reporte_producto');
Route::resource('empleados','App\Http\Controllers\EmpleadoController')->except('show');
Route::get('empleados/reporte/{id}',[EmpleadoController::class,'reporte'])->middleware('auth')->name('generar_reporte_empleado');
Route::resource('categorias','App\Http\Controllers\CategoriaController')->except('show');
Route::get('categorias/reporte/{id}',[CategoriaController::class,'reporte'])->middleware('auth')->name('generar_reporte_categoria');
Route::resource('reportes','App\Http\Controllers\ReporteController')->except('show');
Route::resource('marcas','App\Http\Controllers\MarcaController');
Route::get('marcas/reporte/{id}',[MarcaController::class,'reporte'])->middleware('auth')->name('generar_reporte_marca');
Route::resource('almacens','App\Http\Controllers\AlmacenController')->except('show');
Route::get('almacens/reporte/{id}',[AlmacenController::class,'reporte'])->middleware('auth')->name('generar_reporte_almacenes');
// Implementar luego
// Route::resource('home','App\Http\Controllers\HomeController');
// Route::resource('inicio','App\Http\Controllers\IncioController');

Route::resource('ventas','App\Http\Controllers\VentaController')->except('show');
Route::get('ventas/detalle_venta/{id}',[VentaController::class,'detalle'])->middleware('auth')->name('salidas.detalle_venta');
Route::post('ventas/agregar',[VentaController::class,'agregar'])->middleware('auth')->name('agregar_producto_venta');
Route::post('ventas/guardar',[VentaController::class,'guardar'])->middleware('auth')->name('guardar_venta');
Route::get('ventas/reporte/{id}',[VentaController::class,'reporte'])->middleware('auth')->name('generar_reporte_ventas');
Route::get('ventas/reporte_ind/{id}',[VentaController::class,'reporte_ind'])->middleware('auth')->name('generar_reporte_venta_ind');
Route::get('ventas/nota_ind/{id}',[VentaController::class,'nota_ind'])->middleware('auth')->name('generar_nota_venta_ind');

Route::resource('compras','App\Http\Controllers\CompraController')->except('show');
Route::get('compras/detalle_compra/{id}',[CompraController::class,'detalle'])->middleware('auth')->name('compras.detalle_compra');
Route::post('compras/agregar',[CompraController::class,'agregar'])->middleware('auth')->name('agregar_producto_compra');
Route::post('compras/guardar',[CompraController::class,'guardar'])->middleware('auth')->name('guardar_compra');
Route::get('compras/reporte/{id}',[CompraController::class,'reporte'])->middleware('auth')->name('generar_reporte_compras');
Route::get('compras/reporte_ind/{id}',[CompraController::class,'reporte_ind'])->middleware('auth')->name('generar_reporte_compra_ind');
Route::get('compras/recibo_ind/{id}',[CompraController::class,'recibo_ind'])->middleware('auth')->name('generar_recibo_compra_ind');


Route::get('inventario',[InventarioController::class,'index'])->middleware('auth')->name('inventario.index');
Route::get('existencias',[InventarioController::class,'existencias'])->middleware('auth')->name('inventario.existencias');
Route::post('get_movimientos',[InventarioController::class,'get_movimientos'])->middleware('auth')->name('inventario.get_movimientos');
Route::get('stock',[InventarioController::class,'stock'])->middleware('auth')->name('inventario.stock');
Route::get('reporte_stock',[InventarioController::class,'reporte_stock'])->middleware('auth')->name('inventario.reporte_stock');
Route::get('reporte_valoracion',[InventarioController::class,'reporte_valoracion'])->middleware('auth')->name('inventario.reporte_valoracion');
//Route::get('entradas/reporte',[CompraController::class,'reporte'])->middleware('auth')->name('generar_reporte_entradas');
