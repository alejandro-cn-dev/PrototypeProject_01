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
use App\Models\Reposiciones;
use App\Models\Rol;
use Carbon\Carbon;
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
        $ventas = Venta_cabecera::where('isDeleted', '=', 0)->count();
        $compras = Compra_cabecera::where('isDeleted', '=', 0)->count();
        $empleados = User::where('isDeleted', '=', 0)->count();
        $productos = Producto::where('isDeleted', '=', 0)->count();
        $existencia_adquirida = Compra_detalle::join('productos', 'compra_detalles.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->where('compra_detalles.isDeleted', '=', 0)
            ->where('productos.isDeleted', '=', 0)
            //->where('categorias.nombre','NOT LIKE','%Hilo%')
            ->sum('compra_detalles.cantidad');
        $existencia_vendida = Venta_detalle::join('productos', 'venta_detalles.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->where('venta_detalles.isDeleted', '=', 0)
            ->where('productos.isDeleted', '=', 0)
            //->where('categorias.nombre','NOT LIKE','%Hilo%')
            ->sum('venta_detalles.cantidad');
        $proveedores = Proveedor::where('isDeleted', '=', 0)->count();
        $clientes = Cliente::count();
        $total_compras = Compra_cabecera::where('isDeleted', '=', 0)->sum('monto_total');
        $total_ventas = Venta_cabecera::where('isDeleted', '=', 0)->sum('monto_total');
        // $costos_totales = Compra_detalle::select('costo_compra')->where('isDeleted', '=', 0)->sum('costo_compra');
        // $ingresos_totales = Venta_detalle::select('precio_unitario')->where('isDeleted', '=', 0)->sum('precio_unitario');
        //$ganancias_totales = (($ingresos_totales - $costos_totales) / $ingresos_totales) * 100;
        if ($total_ventas == 0) {
            $ganancias_totales = 0;
        } else {
            $ganancias_totales = (($total_ventas - $total_compras) / $total_compras) * 100;
        }
        $ganancias_totales = number_format($ganancias_totales, 2, ',', ' ');

        // Para cargar la tabla de productos mas vendidos
        //$mas_vendidos = DB::select("SELECT productos.nombre, productos.item_producto, venta_detalles.precio_unitario, SUM(venta_detalles.cantidad) AS ventas_totales, (venta_detalles.precio_unitario * (SUM(venta_detalles.cantidad))) AS total FROM `venta_detalles` JOIN `venta_cabeceras` ON `venta_detalles`.`id_venta` = `venta_cabeceras`.`id` JOIN `productos` ON `venta_detalles`.`id_producto` = `productos`.`id` WHERE venta_detalles.isDeleted = 0 GROUP BY productos.nombre,productos.item_producto,venta_detalles.precio_unitario ORDER BY ventas_totales DESC LIMIT 5");
        $mas_vendidos = DB::table('productos')
            ->join('venta_detalles', 'productos.id', '=', 'venta_detalles.id_producto')
            ->select(
                'productos.id',
                'productos.nombre',
                'productos.item_producto',
                'productos.precio_venta AS precio_unitario',
                DB::raw('SUM(venta_detalles.cantidad) as ventas_totales'),
                DB::raw('(productos.precio_venta * (SUM(venta_detalles.cantidad))) AS total')
            )
            ->groupBy('productos.id', 'productos.nombre','productos.item_producto','productos.precio_venta')
            ->orderByDesc('ventas_totales')
            ->limit(5) // Opcional: limitar a los 10 más vendidos
            ->get();

        // Para cargar la tabla de productos agotados
        $agotados = Producto::join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->join('almacens', 'productos.id_almacen', '=', 'almacens.id')
            ->join('marcas', 'productos.id_marca', '=', 'marcas.id')
            ->select('productos.id', 'productos.item_producto', 'productos.nombre', 'categorias.detalle AS categoria', 'marcas.detalle AS marca', 'productos.color', 'productos.unidad', 'productos.precio_compra', 'productos.precio_venta', DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) - (SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0))) AS `existencias`"))
            ->where('productos.isDeleted', '=', 0)->get();

        $parametros = Parametro::select('valor')->whereIn('nombre', ['existencias_max', 'existencias_min'])->get();
        $min = $parametros[0]->valor;
        $max = $parametros[1]->valor;

        $agotado = $agotados->where('existencias', '=', 0)->take(5);
        $casi_agotado = $agotados->where('existencias', '<=', ((int)$min + 5))->where('existencias','!=',0)->take(5);
        $casi_tope = $agotados->where('existencias', '>=', ((int)$max - 5))->take(5);

        $solicitudes = Reposiciones::whereBetween('created_at', [
            Carbon::now()->startOfWeek(), // Inicio de la semana actual
            Carbon::now()->endOfWeek()    // Fin de la semana actual
        ])->count();
        $num_agotados = $agotados->where('existencias', '=', 0)->count();

        return view(
            'home',
            [
                'ventas' => $ventas,
                'compras' => $compras,
                'empleados' => $empleados,
                'productos' => $productos,
                'existencia_adq' => $existencia_adquirida,
                'existencia_ven' => $existencia_vendida,
                'proveedores' => $proveedores,
                'clientes' => $clientes,
                'total_compras' => $total_compras,
                'total_ventas' => $total_ventas,
                'ganancias' => $ganancias_totales,
                'mas_vendidos' => $mas_vendidos,
                'aux' => $agotado,
                'casi_agotado' => $casi_agotado,
                'casi_tope' => $casi_tope,
                'parametros' => $parametros,
                'SolicitudesVig' => $solicitudes,
                'NoExistencia' => $num_agotados
            ]
        );
        //)->with('SolicitudesVig',$solicitudes)->with('NoExistencia',$agotado);
    }

    public function productosMasVendidos()
    {
        $productosMasVendidos = Venta_detalle::select('venta_detalles.id_producto AS id_producto', 'productos.nombre AS nombre', DB::raw('SUM(venta_detalles.cantidad) as total_vendido'))
            ->join('productos', 'venta_detalles.id_producto', '=', 'productos.id')
            ->groupBy('venta_detalles.id_producto')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();

        return response()->json($productosMasVendidos);
    }
    public function ventasPorMes()
    {
        $ventasPorMes = Venta_cabecera::select(DB::raw('MONTH(fecha_venta) as mes'), DB::raw('SUM(monto_total) as total'))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        return response()->json($ventasPorMes);
    }
    public function obtenerIngresosGastosMensuales()
    {
        $ingresos = DB::table('venta_cabeceras')
            ->selectRaw('DATE_FORMAT(fecha_venta, "%Y-%m") as mes, SUM(monto_total) as total_ingresos')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $gastos = DB::table('compra_cabeceras')
            ->selectRaw('DATE_FORMAT(fecha_compra, "%Y-%m") as mes, SUM(monto_total) as total_gastos')
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        return response()->json([
            'ingresos' => $ingresos,
            'gastos' => $gastos,
        ]);
    }
    public function ventasPorCategoria()
    {
        $ventasPorCategoria = DB::table('venta_detalles')
            ->join('productos', 'venta_detalles.id_producto', '=', 'productos.id')
            ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
            ->select('categorias.nombre as categoria', DB::raw('SUM(venta_detalles.precio_unitario * venta_detalles.cantidad) as total_ventas'))
            ->groupBy('categorias.nombre')
            ->orderBy('total_ventas', 'desc')
            ->get();

        return response()->json($ventasPorCategoria);
    }
    public function obtenerDatosParaProyecciones()
    {
        $ventas = DB::table('venta_cabeceras')
            ->selectRaw('DATE_FORMAT(fecha_venta, "%Y-%m") as periodo, SUM(monto_total) as total_ventas')
            ->groupBy('periodo')
            ->orderBy('periodo')
            ->get();

        return response()->json($ventas);
    }
    public function calcularProyecciones()
    {
        $ventas = DB::table('venta_cabeceras')
            ->selectRaw('DATE_FORMAT(fecha_venta, "%Y-%m") as periodo, SUM(monto_total) as total_ventas')
            ->groupBy('periodo')
            ->orderBy('periodo')
            ->get();

        $datos = $ventas->pluck('total_ventas')->toArray();

        $tasaCrecimiento = 1.05; // Supongamos un crecimiento del 5% mensual
        $proyecciones = [];
        $ultimoMes = $ventas->last()->periodo;

        for ($i = 1; $i <= 6; $i++) { // Proyectamos para los próximos 6 meses
            $ultimoValor = end($datos) * $tasaCrecimiento;
            $datos[] = $ultimoValor;
            $proyecciones[] = [
                'periodo' => date('Y-m', strtotime("+$i month", strtotime($ultimoMes))),
                'total_ventas' => round($ultimoValor, 2),
            ];
        }

        return response()->json([
            'historico' => $ventas,
            'proyecciones' => $proyecciones,
        ]);
    }
    public function horasPicoVentas()
    {
        $ventasPorHora = DB::table('venta_cabeceras')
            ->selectRaw('HOUR(hora_venta) as hora, COUNT(*) as total_ventas')
            ->groupBy('hora')
            ->orderBy('hora')
            ->get();

        return response()->json($ventasPorHora);
    }
}
