<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\EntradaController;

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
Route::resource('empleados','App\Http\Controllers\EmpleadoController');
Route::resource('categorias','App\Http\Controllers\CategoriaController');
Route::resource('reportes','App\Http\Controllers\ReporteController');
Route::resource('marcas','App\Http\Controllers\MarcaController');
Route::resource('almacens','App\Http\Controllers\AlmacenController');
Route::resource('home','App\Http\Controllers\HomeController');
Route::resource('inicio','App\Http\Controllers\IncioController');

Route::resource('salidas','App\Http\Controllers\SalidaController');
Route::get('salidas/detalle_salida/{id}',[SalidaController::class,'detalle'])->middleware('auth')->name('salidas.detalle');
Route::post('salidas/agregar',[SalidaController::class,'agregar'])->middleware('auth')->name('agregar_producto_salida');
Route::post('salidas/guardar',[SalidaController::class,'guardar'])->middleware('auth')->name('guardar_salida');
Route::get('salidas/report',[SalidaController::class,'report'])->middleware('auth');

Route::resource('entradas','App\Http\Controllers\EntradaController');
Route::get('entradas/detalle_entrada/{id}',[EntradaController::class,'detalle'])->middleware('auth')->name('entradas.detalle');
Route::post('entradas/agregar',[EntradaController::class,'agregar'])->middleware('auth')->name('agregar_producto_entrada');
Route::post('entradas/guardar',[EntradaController::class,'guardar'])->middleware('auth')->name('guardar_entrada');
Route::get('entradas/report',[EntradaController::class,'report'])->middleware('auth');
