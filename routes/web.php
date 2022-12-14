<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\EntradaController;
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

Route::resource('salidas','App\Http\Controllers\SalidaController');
Route::get('salidas/detalle_salida/{id}',[SalidaController::class,'detalle'])->middleware('auth')->name('salidas.detalle_salida');
Route::post('salidas/agregar',[SalidaController::class,'agregar'])->middleware('auth')->name('agregar_producto_salida');
Route::post('salidas/guardar',[SalidaController::class,'guardar'])->middleware('auth')->name('guardar_salida');
Route::get('salidas/reporte/{id}',[SalidaController::class,'reporte'])->middleware('auth')->name('generar_reporte_salidas');
Route::get('salidas/reporte_ind/{id}',[SalidaController::class,'reporte_ind'])->middleware('auth')->name('generar_reporte_salida_ind');

Route::resource('entradas','App\Http\Controllers\EntradaController');
Route::get('entradas/detalle_entrada/{id}',[EntradaController::class,'detalle'])->middleware('auth')->name('entradas.detalle_entrada');
Route::post('entradas/agregar',[EntradaController::class,'agregar'])->middleware('auth')->name('agregar_producto_entrada');
Route::post('entradas/guardar',[EntradaController::class,'guardar'])->middleware('auth')->name('guardar_entrada');
//Route::get('entradas/reporte',[EntradaController::class,'reporte'])->middleware('auth')->name('generar_reporte_entradas');
