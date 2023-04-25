<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('page_home');

Route::resource('productos','App\Http\Controllers\ProductoController');
Route::get('productos/reporte/{id}',[ProductoController::class,'reporte'])->middleware('auth')->name('generar_reporte_producto');
Route::resource('empleados','App\Http\Controllers\EmpleadoController');
Route::get('empleados/reporte/{id}',[EmpleadoController::class,'reporte'])->middleware('auth')->name('generar_reporte_empleado');
Route::resource('categorias','App\Http\Controllers\CategoriaController');
Route::get('categorias/reporte/{id}',[CategoriaController::class,'reporte'])->middleware('auth')->name('generar_reporte_categoria');
Route::resource('reportes','App\Http\Controllers\ReporteController');
Route::resource('marcas','App\Http\Controllers\MarcaController');
Route::get('marcas/reporte/{id}',[MarcaController::class,'reporte'])->middleware('auth')->name('generar_reporte_marca');
Route::resource('almacens','App\Http\Controllers\AlmacenController');
Route::get('almacens/reporte/{id}',[AlmacenController::class,'reporte'])->middleware('auth')->name('generar_reporte_almacenes');
Route::resource('home','App\Http\Controllers\HomeController');
Route::resource('inicio','App\Http\Controllers\IncioController');

Route::resource('ventas','App\Http\Controllers\VentaController');
Route::get('ventas/detalle_venta/{id}',[VentaController::class,'detalle'])->middleware('auth')->name('salidas.detalle_venta');
Route::post('ventas/agregar',[VentaController::class,'agregar'])->middleware('auth')->name('agregar_producto_venta');
Route::post('ventas/guardar',[VentaController::class,'guardar'])->middleware('auth')->name('guardar_venta');
Route::get('ventas/reporte/{id}',[VentaController::class,'reporte'])->middleware('auth')->name('generar_reporte_ventas');
Route::get('ventas/reporte_ind/{id}',[VentaController::class,'reporte_ind'])->middleware('auth')->name('generar_reporte_venta_ind');

Route::resource('compras','App\Http\Controllers\CompraController');
Route::get('compras/detalle_compra/{id}',[CompraController::class,'detalle'])->middleware('auth')->name('compras.detalle_compra');
Route::post('compras/agregar',[CompraController::class,'agregar'])->middleware('auth')->name('agregar_producto_compra');
Route::post('compras/guardar',[CompraController::class,'guardar'])->middleware('auth')->name('guardar_compra');
Route::get('compras/reporte/{id}',[CompraController::class,'reporte'])->middleware('auth')->name('generar_reporte_compras');
Route::get('compras/reporte_ind/{id}',[CompraController::class,'reporte_ind'])->middleware('auth')->name('generar_reporte_compra_ind');

//Route::get('entradas/reporte',[CompraController::class,'reporte'])->middleware('auth')->name('generar_reporte_entradas');
