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

//Route::get('/', function () { return view('login'); });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('productos','App\Http\Controllers\ProductoController');
Route::resource('empleados','App\Http\Controllers\EmpleadoController');
//Route::get('/entradas',[App\Http\Controllers\InventarioController::class, 'indexEntradas'])->name('entradas');
//Route::get('/salidas',[App\Http\Controllers\InventarioController::class, 'indexSalidas'])->name('salidas');
Route::resource('entradas','App\Http\Controllers\EntradaController');
Route::resource('salidas','App\Http\Controllers\SalidaController');
Route::resource('categorias','App\Http\Controllers\CategoriaController');
Route::resource('reportes','App\Http\Controllers\ReporteController');

//Route::get('/reportes', function () {return view('marcas.index');});
/*Route::get('categorias/index',[CategoriaController::class, 'index'])->middleware('auth')->name('categorias');
Route::get('categorias/create/{id}',[CategoriaController::class, 'create'])->middleware('auth')->name('categorias.create');
Route::post('categorias/store',[CategoriaController::class, 'store'])->middleware('auth')->name('categorias.store');
Route::get('categorias/edit/{id}',[CategoriaController::class, 'edit'])->middleware('auth')->name('categorias.edit');
Route::put('categorias/update/{id}',[CategoriaController::class, 'update'])->middleware('auth')->name('categorias.update');*/

Route::resource('marcas','App\Http\Controllers\MarcaController');
Route::resource('almacens','App\Http\Controllers\AlmacenController');
Route::resource('home','App\Http\Controllers\HomeController');
Route::resource('inicio','App\Http\Controllers\IncioController');