<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Auth;

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
Route::get('empleados/perfil',[EmpleadoController::class,'perfil'])->middleware('auth')->name('ver_perfil');
Route::get('reporte_test',[PageController::class,'reporte_test'])->name('reporte_test');

Route::get('config',[ConfigController::class,'get_params'])->name('params');
Route::get('config/{id}',[ConfigController::class,'get_param'])->name('param');
Route::post('update_params/{id}',[ConfigController::class,'up_params'])->name('update_params');

Route::resource('productos','App\Http\Controllers\ProductoController')->except('show');
Route::get('productos/reporte/{id}',[ProductoController::class,'reporte'])->middleware('auth')->name('generar_reporte_producto');
Route::resource('empleados','App\Http\Controllers\EmpleadoController')->except('show');
Route::get('empleados/reporte/{id}',[EmpleadoController::class,'reporte'])->middleware('auth')->name('generar_reporte_empleado');
Route::get('empleados/restablecer/{id}',[EmpleadoController::class,'form_cambio_contraseña'])->middleware('auth')->name('form_cambio_contraseña');
Route::post('empleados/cambio',[EmpleadoController::class,'cambio'])->middleware('auth')->name('cambio_contraseña');
Route::resource('categorias','App\Http\Controllers\CategoriaController')->except('show');
Route::get('categorias/reporte/{id}',[CategoriaController::class,'reporte'])->middleware('auth')->name('generar_reporte_categoria');
Route::resource('reportes','App\Http\Controllers\ReporteController')->except('show');
Route::resource('marcas','App\Http\Controllers\MarcaController');
Route::get('marcas/reporte/{id}',[MarcaController::class,'reporte'])->middleware('auth')->name('generar_reporte_marca');
Route::resource('almacenes','App\Http\Controllers\AlmacenController')->except('show');
Route::get('almacenes/reporte/{id}',[AlmacenController::class,'reporte'])->middleware('auth')->name('generar_reporte_almacenes');
Route::resource('proveedores','App\Http\Controllers\ProveedorController')->except('show');
Route::get('proveedores/reporte',[ProveedorController::class,'reporte'])->middleware('auth')->name('generar_reporte_proveedores');

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
Route::get('ventas/clientes',[VentaController::class,'clientes'])->middleware('auth');
Route::post('ventas/getClientes',[VentaController::class,'getClientes'])->middleware('auth')->name('consulta_clientes');

Route::resource('compras','App\Http\Controllers\CompraController')->except('show');
Route::get('compras/detalle_compra/{id}',[CompraController::class,'detalle'])->middleware('auth')->name('compras.detalle_compra');
Route::post('compras/agregar',[CompraController::class,'agregar'])->middleware('auth')->name('agregar_producto_compra');
Route::post('compras/guardar',[CompraController::class,'guardar'])->middleware('auth')->name('guardar_compra');
Route::get('compras/reporte/{id}',[CompraController::class,'reporte'])->middleware('auth')->name('generar_reporte_compras');
Route::get('compras/reporte_ind/{id}',[CompraController::class,'reporte_ind'])->middleware('auth')->name('generar_reporte_compra_ind');
Route::get('compras/recibo_ind/{id}',[CompraController::class,'recibo_ind'])->middleware('auth')->name('generar_recibo_compra_ind');


Route::get('inventario',[InventarioController::class,'index'])->middleware('auth')->name('inventario.index');
Route::get('existencias',[InventarioController::class,'existencias'])->middleware('auth')->name('inventario.existencias');
Route::post('existencias/{select}',[InventarioController::class,'existencias_select'])->middleware('auth')->name('existencias_select');
Route::get('export_reporte_existencias/{arg}',[InventarioController::class,'export_reporte_existencias'])->middleware('auth')->name('generar_reporte_existencias');
Route::post('get_movimientos',[InventarioController::class,'get_movimientos'])->middleware('auth')->name('inventario.get_movimientos');
Route::get('kardex',[InventarioController::class,'stock'])->middleware('auth')->name('inventario.kardex');
Route::get('ficha_kardex',[InventarioController::class,'ficha_kardex'])->middleware('auth')->name('inventario.ficha_kardex');
Route::get('reporte_ficha_kardex',[InventarioController::class,'reporte_ficha_kardex'])->middleware('auth')->name('reporte_ficha_kardex');
Route::post('stock/ficha',[InventarioController::class,'ficha_kardex_fecha'])->middleware('auth')->name('ficha_kardex_fecha');
Route::post('stock/fecha',[InventarioController::class,'stock_fecha'])->middleware('auth')->name('stock_fecha');
Route::get('reporte_stock',[InventarioController::class,'reporte_stock'])->middleware('auth')->name('inventario.reporte_stock');
Route::get('reporte_valoracion',[InventarioController::class,'reporte_valoracion'])->middleware('auth')->name('inventario.reporte_valoracion');
Route::get('reporte_ventas',[InventarioController::class,'reporte_ventas'])->middleware('auth')->name('inventario.reporte_ventas');
Route::get('reporte_ventas_detalle',[InventarioController::class,'reporte_ventas_detalle'])->middleware('auth')->name('inventario.reporte_ventas_detalle');
Route::post('reporte_ventas/fecha',[InventarioController::class,'reporte_ventas_criterio'])->middleware('auth')->name('json_reporte_ventas_producto');
Route::post('reporte_ventas_detalle/fecha',[InventarioController::class,'reporte_ventas_criterio_2'])->middleware('auth')->name('json_reporte_ventas_detalle');
Route::get('export_reporte_ventas_by_arg/{arg}',[InventarioController::class,'export_reporte_ventas_by_arg'])->middleware('auth')->name('pdf_reporte_ventas_arg');
Route::get('export_reporte_ventas_by_date/{date}',[InventarioController::class,'export_reporte_ventas_by_date'])->middleware('auth')->name('pdf_reporte_ventas_date');
//Route::get('entradas/reporte',[CompraController::class,'reporte'])->middleware('auth')->name('generar_reporte_entradas');
