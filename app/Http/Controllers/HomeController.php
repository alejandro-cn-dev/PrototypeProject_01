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
use App\Models\Parametro;
use App\Models\Cliente;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;

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
        //->where('categorias.nombre','NOT LIKE','%Hilo%')
        ->sum('compra_detalles.cantidad');
        $existencia_vendida = Venta_detalle::join('productos','venta_detalles.id_producto','=','productos.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->where('venta_detalles.isDeleted','=',0)
        ->where('productos.isDeleted','=',0)
        //->where('categorias.nombre','NOT LIKE','%Hilo%')
        ->sum('venta_detalles.cantidad');
        $proveedores = Proveedor::where('isDeleted','=',0)->count();
        $clientes = Cliente::count();
        $total_compras = Compra_cabecera::where('isDeleted','=',0)->sum('monto_total');
        $total_ventas = Venta_cabecera::where('isDeleted','=',0)->sum('monto_total');
        $costos_totales = Compra_detalle::select('costo_compra')->where('isDeleted','=',0)->sum('costo_compra');
        $ingresos_totales = Venta_detalle::select('precio_unitario')->where('isDeleted','=',0)->sum('precio_unitario');
        //$ganancias_totales = (($ingresos_totales - $costos_totales) / $ingresos_totales) * 100;
        if($total_ventas == 0){
            $ganancias_totales = 0;
        }else{
            $ganancias_totales = (($total_ventas - $total_compras) / $total_compras) * 100;
        }
        $ganancias_totales = number_format($ganancias_totales, 2, ',', ' ');

        // Para cargar la tabla de productos mas vendidos
        $mas_vendidos = DB::select("SELECT productos.nombre, productos.item_producto, venta_detalles.precio_unitario, SUM(venta_detalles.cantidad) AS ventas_totales, (venta_detalles.precio_unitario * (SUM(venta_detalles.cantidad))) AS total FROM `venta_detalles` JOIN `venta_cabeceras` ON `venta_detalles`.`id_venta` = `venta_cabeceras`.`id` JOIN `productos` ON `venta_detalles`.`id_producto` = `productos`.`id` WHERE venta_detalles.isDeleted = 0 GROUP BY productos.nombre,productos.item_producto,venta_detalles.precio_unitario ORDER BY ventas_totales DESC LIMIT 5");
        // Para cargar la tabla de productos agotados
        $agotados = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.nombre','categorias.detalle AS categoria','marcas.detalle AS marca','productos.color','productos.unidad','productos.precio_compra','productos.precio_venta',DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) - (SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0))) AS `existencias`"))
        ->where('productos.isDeleted','=',0)->get();

        $parametros = Parametro::select('valor')->whereIn('nombre',['existencias_max','existencias_min'])->get();
        $min = $parametros[0]->valor;
        $max = $parametros[1]->valor;

        $aux = $agotados->where('existencias','=',0)->take(5);
        $aux1 = $agotados->where('existencias','<=',((int)$min+5))->take(5);
        $aux2 = $agotados->where('existencias','>=',((int)$max-5))->take(5);

        return view('home',
        ['ventas'=>$ventas,
        'compras'=>$compras,
        'empleados'=>$empleados,
        'productos'=>$productos,
        'existencia_adq'=>$existencia_adquirida,
        'existencia_ven'=>$existencia_vendida,
        'proveedores'=>$proveedores,
        'clientes'=>$clientes,
        'total_compras'=>$total_compras,
        'total_ventas'=>$total_ventas,
        'ganancias'=>$ganancias_totales,
        'mas_vendidos'=>$mas_vendidos,
        'aux'=>$aux,
        'casi_agotado'=>$aux1,
        'casi_tope'=>$aux2,
        'parametros'=>$parametros]);
    }
}
