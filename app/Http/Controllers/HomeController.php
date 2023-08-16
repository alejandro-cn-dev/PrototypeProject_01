<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta_cabecera;
use App\Models\Venta_detalle;
use App\Models\Compra_cabecera;
use App\Models\Compra_detalle;
use App\Models\User;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\Rol;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ventas = Venta_cabecera::where('isDeleted','=',0)->count();
        $compras = Compra_cabecera::where('isDeleted','=',0)->count();
        $empleados = User::where('isDeleted','=',0)->count();
        $productos = Producto::where('isDeleted','=',0)->count();
        $existencia_adquirida = Compra_detalle::join('productos','compra_detalles.id_producto','=','productos.id')        
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->where('compra_detalles.isDeleted','=',0)
        ->where('productos.isDeleted','=',0)
        ->where('categorias.nombre','NOT LIKE','%Hilo%')
        ->sum('compra_detalles.cantidad');
        $existencia_vendida = Venta_detalle::join('productos','venta_detalles.id_producto','=','productos.id')        
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->where('venta_detalles.isDeleted','=',0)
        ->where('productos.isDeleted','=',0)
        ->where('categorias.nombre','NOT LIKE','%Hilo%')
        ->sum('venta_detalles.cantidad');
        $proveedores = Proveedor::where('isDeleted','=',0)->count();
        $clientes = Cliente::count();
        $total_compras = Compra_cabecera::where('isDeleted','=',0)->sum('monto_total');
        $total_ventas = Venta_cabecera::where('isDeleted','=',0)->sum('monto_total');
        return view('home')
        ->with('ventas',$ventas)
        ->with('compras',$compras)
        ->with('empleados',$empleados)
        ->with('productos',$productos)
        ->with('existencia_adq',$existencia_adquirida)
        ->with('existencia_ven',$existencia_vendida)
        ->with('proveedores',$proveedores)
        ->with('clientes',$clientes)
        ->with('total_compras',$total_compras)
        ->with('total_ventas',$total_ventas);
    }
}
