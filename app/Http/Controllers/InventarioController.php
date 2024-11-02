<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra_detalle;
use App\Models\Venta_detalle;
use App\Models\Compra_cabecera;
use App\Models\Venta_cabecera;
use App\Models\Producto;
use App\Models\Parametro;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Arg;
use Svg\Tag\Rect;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta_detalle::join('productos','venta_detalles.id_producto','=','productos.id')
        ->join('venta_cabeceras','venta_detalles.id_venta','=','venta_cabeceras.id')
        ->select('precio_unitario AS costo','cantidad','id_producto','venta_cabeceras.fecha_venta AS fecha','productos.nombre','productos.item_producto',DB::raw("'salida' AS tipo"))
        ->where('venta_detalles.isDeleted','=',0);
        $inventario = Compra_detalle::join('productos','compra_detalles.id_producto','=','productos.id')
        ->join('compra_cabeceras','compra_detalles.id_compra','=','compra_cabeceras.id')
        ->select('costo_compra AS costo','cantidad','id_producto','compra_cabeceras.fecha_compra AS fecha','productos.nombre','productos.item_producto',DB::raw("'entrada' AS tipo"))
        ->where('compra_detalles.isDeleted','=',0)
        ->union($ventas)->get();
        return view('inventario.index')->with('inventarios',$inventario);
    }

    /**
     * Funciones propias
     */
    public function existencias()
    {
        $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.nombre','productos.calidad','productos.medida','categorias.detalle AS categoria','marcas.detalle AS marca','productos.color','productos.unidad','productos.precio_compra','productos.precio_venta',DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) - (SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0))) AS existencias"))
        ->where('productos.isDeleted','=',0)->get();
        $parametros = Parametro::select('valor')->whereIn('nombre',['existencias_max','existencias_min'])->get();
        $min = $parametros[0]->valor;
        $max = $parametros[1]->valor;
        return view('inventario.existencias')->with('productos',$productos)->with('min',$min)->with('max',$max);
    }
    public function existencias_select($select)
    {
        $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.nombre','categorias.detalle AS categoria','marcas.detalle AS marca','productos.color','productos.unidad','productos.precio_compra','productos.precio_venta',DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) - (SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0))) AS existencias"))
        ->where('productos.isDeleted','=',0)->get();

        return response()->json(['response'=>$productos]);
    }
    public function export_reporte_existencias ($arg)
    {
        $repuesta = collect();
        $cabecera = "";
        $parametros = Parametro::select('valor')->whereIn('nombre',['existencias_max','existencias_min'])->get();
        $min = $parametros[0]->valor;
        $max = $parametros[1]->valor;
        $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.nombre','categorias.detalle AS categoria','marcas.detalle AS marca','productos.color','productos.unidad','productos.precio_compra','productos.precio_venta',DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) - (SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0))) AS existencias"))
        ->where('productos.isDeleted','=',0)->get();
        // $repuesta = $productos->filter(function ($producto){
        //     return in_array($producto->existencias,'==',0);
        // });
        if($arg == 'all'){ $respuesta = $productos; $cabecera = "Existencias de todos los productos";}
        if($arg == 'zero'){ $respuesta = $productos->where('existencias','==',0); $cabecera = "Productos agotados";}
        if($arg == 'min'){ $respuesta = $productos->where('existencias','>',0)->where('existencias','<=',$min); $cabecera = "Productos por agotarse";}
        if($arg == 'amax'){ $respuesta = $productos->where('existencias','<',$max)->where('existencias','>=',($max-10)); $cabecera = "Productos cerca del límite de stock máximo";}
        if($arg == 'max'){ $respuesta = $productos->where('existencias','==',$max); $cabecera = "Productos en stock máximo";}

        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('inventario/pdf_existencias',compact('respuesta','fecha','cabecera'));
        return $pdf->download();

        //return response()->json(['data'=>$respuesta]);
    }
    public function get_movimientos(Request $request)
    {
        if($request->criterio != 'ventas' && $request->criterio != 'compras'){
            $ventas1 = Venta_detalle::join('productos','venta_detalles.id_producto','=','productos.id')
            ->join('venta_cabeceras','venta_detalles.id_venta','=','venta_cabeceras.id')
            ->select('precio_unitario AS costo','cantidad','id_producto','venta_cabeceras.fecha_venta AS fecha','productos.nombre AS producto','productos.item_producto',DB::raw("'salida' AS tipo"))
            ->where('venta_detalles.isDeleted','=',0);
            //->get();
            $compras1 = Compra_detalle::join('productos','compra_detalles.id_producto','=','productos.id')
            ->join('compra_cabeceras','compra_detalles.id_compra','=','compra_cabeceras.id')
            ->select('costo_compra AS costo','cantidad','id_producto','compra_cabeceras.fecha_compra AS fecha','productos.nombre AS producto','productos.item_producto',DB::raw("'entrada' AS tipo"))
            ->where('compra_detalles.isDeleted','=',0)
            //->where('compra_cabeceras.isDeleted','=',0)
            ->union($ventas1)->get();
            //->get();
            //$respuesta = $compras1->merge($ventas1);
            $respuesta = $compras1;
        }
        if($request->criterio == 'ventas'){
            $respuesta = Venta_detalle::join('productos','venta_detalles.id_producto','=','productos.id')
            ->join('venta_cabeceras','venta_detalles.id_venta','=','venta_cabeceras.id')
            ->select('precio_unitario AS costo','cantidad','id_producto','venta_cabeceras.fecha_venta AS fecha','productos.nombre AS producto','productos.item_producto',DB::raw("'salida' AS tipo"))
            ->where('venta_detalles.isDeleted','=',0)
            ->get();
        }
        if($request->criterio == 'compras'){
            $respuesta = Compra_detalle::join('productos','compra_detalles.id_producto','=','productos.id')
            ->join('compra_cabeceras','compra_detalles.id_compra','=','compra_cabeceras.id')
            ->select('costo_compra AS costo','cantidad','id_producto','compra_cabeceras.fecha_compra AS fecha','productos.nombre AS producto','productos.item_producto',DB::raw("'entrada' AS tipo"))
            ->where('compra_detalles.isDeleted','=',0)
            ->get();
        }
        return response()->json(['respuesta'=>$respuesta]);
    }
    public function stock()
    {
        $productos = Producto::select('nombre','item_producto','precio_compra','precio_venta',DB::raw("(SELECT SUM(cantidad) FROM compra_detalles WHERE (id_producto = productos.id)AND (isDeleted = 0)) AS entradas"),DB::raw("(SELECT SUM(cantidad) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) AS salidas"))
        ->where('isDeleted','=',0)
        ->get();

        return view('inventario.control_stock')->with('productos',$productos);
    }
    public function ficha_kardex()
    {
        $productos = Producto::select('id','nombre','item_producto','precio_compra','precio_venta',DB::raw("(SELECT SUM(cantidad) FROM compra_detalles WHERE (id_producto = productos.id)AND (isDeleted = 0)) AS entradas"),DB::raw("(SELECT SUM(cantidad) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) AS salidas"))
        ->where('isDeleted','=',0)
        ->get();

        return view('inventario.ficha_kardex')->with('productos',$productos);
    }
    public function ficha_kardex_fecha(Request $request)
    {
        // reglas de validación
        $rules = [
            'producto'         => 'required|integer'
        ];
        // Mensajes de error personalizados
        $custom_messages = [
            'producto.required' => 'Debe escoger algun producto para mostrar el detalle',
            'producto.integer' => 'Hubo un problema con la identificación del producto'
        ];
        // Validacion de Request
        $validator = $this->validate($request,$rules,$custom_messages);

        // Proceso
        //$producto = Producto::find($request->producto);
        $producto = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.nombre','categorias.detalle AS categoria','marcas.detalle AS marca','almacens.nombre AS ubicacion','productos.color','productos.unidad','productos.precio_compra','productos.precio_venta')
        ->where('productos.isDeleted','=',0)->where('productos.id','=',$request->producto)->first();

        $entradas = Compra_detalle::where('isDeleted','=',0)->where('id_producto','=',$request->producto)->sum('cantidad');
        $salidas = Venta_detalle::where('isDeleted','=',0)->where('id_producto','=',$request->producto)->sum('cantidad');

        $saldo = $entradas-$salidas;
        // $entradas = Compra_detalle::join('compra_cabeceras','compra_detalles.id_compra','=','compra_cabeceras.id')
        // ->select('compra_cabeceras.fecha_compra AS fecha','("COMPRAS") + compra_cabeceras.numeracion AS descripcion','0 AS inv_inicial','compra_detalles.costo_compra AS costo_unitario','')
        // ->where('compra_detalles.isDeleted','=',0)->where('compra_detalles.id_producto','=',$request->producto)
        // ->get();

        $detalle_ficha = DB::select("CALL sp_get_detalle_ficha_kardex (".$request->producto.")");
        //$detalle_ficha = "Test1";

        return response()->json(['producto'=>$producto, 'detalle'=>$detalle_ficha, 'saldo'=>$saldo]);
    }
    public function reporte_ficha_kardex($id)
    {
        $producto = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.nombre','categorias.detalle AS categoria','marcas.detalle AS marca','almacens.nombre AS ubicacion','productos.color','productos.unidad','productos.precio_compra','productos.precio_venta')
        ->where('productos.isDeleted','=',0)->where('productos.id','=',$id)->first();
        $detalle = DB::select("CALL sp_get_detalle_ficha_kardex (".$id.")");
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('inventario/pdf_tarjeta_kardex',compact('producto','detalle','fecha'));
        return $pdf->download();
        //return $pdf->download('tarjeta_kardex_'.$producto->item_producto.'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return response()->json(['test'=>'XDDDD']);
    }
    public function stock_fecha(Request $request)
    {
        // reglas de validación
        $rules = [
            'fecha_inicio'     => 'required',
            'fecha_final'      => 'required|after_or_equal:fecha_inicio'
        ];
        // Mensajes de error personalizados
        $custom_messages = [
            'fecha_inicio.required' => 'Debe escribir una fecha inicial',
            'fecha_final.required' => 'Debe escribir una fecha final',
            'fecha_final.after_or_equal' => 'La fecha final no debe ser mayor a la inicial'
        ];
        // Validacion de Request
        $validator = $this->validate($request,$rules,$custom_messages);

        // Consulta a BD con las fechas inicial y final
        // Consulta de por fechas y por producto en Compras
        $consulta_compras = str_replace(array("|fechainicio",":fechafinal"),array($request->fecha_inicio,$request->fecha_final),"(SELECT SUM(compra_detalles.cantidad) FROM compra_cabeceras INNER JOIN compra_detalles ON compra_cabeceras.id = compra_detalles.id_compra WHERE (compra_detalles.id_producto = productos.id) AND (compra_cabeceras.isDeleted = 0) AND (compra_cabeceras.fecha_compra BETWEEN '|fechainicio' AND ':fechafinal')) AS entradas");
        $consulta_ventas = str_replace(array("|fechainicio",":fechafinal"),array($request->fecha_inicio,$request->fecha_final),"(SELECT SUM(venta_detalles.cantidad) FROM venta_cabeceras INNER JOIN venta_detalles ON venta_cabeceras.id = venta_detalles.id_venta WHERE (venta_detalles.id_producto = productos.id) AND (venta_cabeceras.isDeleted = 0) AND (venta_cabeceras.fecha_venta BETWEEN '|fechainicio' AND ':fechafinal')) AS salidas");
        $stock_inicial = str_replace(":fechatop",$request->fecha_inicio,"((SELECT COALESCE(SUM(compra_detalles.cantidad),0) FROM compra_cabeceras INNER JOIN compra_detalles ON compra_cabeceras.id = compra_detalles.id_compra WHERE (compra_detalles.id_producto = productos.id) AND (compra_cabeceras.fecha_compra) AND (compra_cabeceras.isDeleted = 0) AND (compra_cabeceras.fecha_compra < ':fechatop')) - (SELECT COALESCE(SUM(venta_detalles.cantidad),0) FROM venta_cabeceras INNER JOIN venta_detalles ON venta_cabeceras.id = venta_detalles.id_venta WHERE (venta_detalles.id_producto = productos.id) AND (venta_cabeceras.fecha_venta) AND (venta_cabeceras.isDeleted = 0) AND (venta_cabeceras.fecha_venta < ':fechatop'))) AS stock_inicial");
        $respuesta = Producto::select(
            'nombre',
            'item_producto',
            'precio_compra',
            'precio_venta',
            DB::raw($consulta_compras),
            DB::raw($consulta_ventas),
            DB::raw($stock_inicial))
        ->where('isDeleted','=',0)
        ->get();

        return response()->json(['respuesta'=>$respuesta]);
    }
    public function reporte_stock()
    {
        $productos = Producto::select('nombre','item_producto','precio_compra','precio_venta',DB::raw("(SELECT SUM(cantidad) FROM compra_detalles WHERE id_producto = productos.id) AS entradas"),DB::raw("(SELECT SUM(cantidad) FROM venta_detalles WHERE id_producto = productos.id) AS salidas"))
        ->where('isDeleted','=',0)
        ->get();

        return view('inventario.control_stock')->with('productos',$productos);
    }

    public function reporte_valoracion()
    {
        $valoraciones = Producto::select(
            'item_producto',
            'nombre',
            'created_at',
            DB::raw("(SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) AS entradas"),
            'precio_compra',
            DB::raw("(SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) AS salidas"),
            'precio_venta')
        ->where('isDeleted','=',0)
        ->get();


        return view('inventario.valoracion')->with('valoraciones',$valoraciones);
    }
    public function reporte_ventas()
    {
        //$ventas = Venta_cabecera::where()->get();
        //$ventas = Venta_detalle::where('isDeleted','=',0)->get();
        $ventas = DB::select("CALL get_reporte_venta_by_arg ('all')");
        return view('inventario.ventas_producto')->with('ventas',$ventas);
        //return response()->json(['ventas'=>$ventas]);
    }
    public function reporte_ventas_detalle()
    {
        //$ventas = Venta_cabecera::where()->get();
        //$ventas = Venta_detalle::where('isDeleted','=',0)->get();
        $ventas = DB::select("CALL get_reporte_venta_by_arg_2 ('all')");
        return view('inventario.ventas_detalle')->with('ventas',$ventas);
        //return response()->json(['ventas'=>$ventas]);
    }
    public function reporte_ventas_criterio(Request $request)
    {
        if($request->param == 'fecha'){
            $ventas = DB::select("CALL get_reporte_venta_by_date ('".$request->fecha_inicio."','".$request->fecha_fin."')");
            //$ventas = DB::select("SET @p0='".$request->fecha_inicio."'; SET @p1='".$request->fecha_fin."'; CALL `get_reporte_venta_by_date`(@p0, @p1);");
        }else{
            $ventas = DB::select("CALL get_reporte_venta_by_arg ('".$request->param."')");
        }
        return response()->json(['respuesta'=>$ventas]);
    }
    public function reporte_ventas_criterio_2(Request $request)
    {
        if($request->param == 'fecha'){
            $ventas = DB::select("CALL get_reporte_venta_by_date_2 ('".$request->fecha_inicio."','".$request->fecha_fin."')");
            //$ventas = DB::select("SET @p0='".$request->fecha_inicio."'; SET @p1='".$request->fecha_fin."'; CALL `get_reporte_venta_by_date`(@p0, @p1);");
        }else{
            $ventas = DB::select("CALL get_reporte_venta_by_arg_2 ('".$request->param."')");
        }
        return response()->json(['respuesta'=>$ventas]);
    }
    public function export_reporte_ventas_by_arg($arg)
    {
        $repuesta = collect();
        $cabecera = "";
        $args = explode("|",$arg);
        if($args[0] == 'producto'){
            switch($args[1]){
                case 'all':
                    $respuesta = DB::select("CALL get_reporte_venta_by_arg ('all')"); $cabecera = "Ventas de todos los productos";
                    break;
                case 'hoy':
                    $respuesta = DB::select("CALL get_reporte_venta_by_arg ('hoy')"); $cabecera = "Ventas de hoy por producto";
                    break;
                case 'sem':
                    $respuesta = DB::select("CALL get_reporte_venta_by_arg ('sem')"); $cabecera = "Ventas de la semana por producto";
                    break;
                case 'mes':
                    $respuesta = DB::select("CALL get_reporte_venta_by_arg ('mes')"); $cabecera = "Ventas del mes por producto";
                    break;
            }
        }else if($args[0] == 'detalle'){
            switch($args[1]){
                case 'all':
                    $respuesta = DB::select("CALL get_reporte_venta_by_arg_2 ('all')"); $cabecera = "Todas las ventas";
                    break;
                case 'hoy':
                    $respuesta = DB::select("CALL get_reporte_venta_by_arg_2 ('hoy')"); $cabecera = "Ventas de hoy";
                    break;
                case 'sem':
                    $respuesta = DB::select("CALL get_reporte_venta_by_arg_2 ('sem')"); $cabecera = "Ventas de la semana";
                    break;
                case 'mes':
                    $respuesta = DB::select("CALL get_reporte_venta_by_arg_2 ('mes')"); $cabecera = "Ventas del mes";
                    break;
            }
        }


        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        if($args[0] == 'detalle'){
            $pdf = PDF::loadView('inventario/pdf_ventas_detalle',compact('respuesta','fecha','cabecera'));
        }else{
            $pdf = PDF::loadView('inventario/pdf_ventas_producto',compact('respuesta','fecha','cabecera'));
        }

        return $pdf->download();
    }
    public function export_reporte_ventas_by_date($date)
    {
        $repuesta = collect();
        $cabecera = "";
        $fechas = explode("|",$date);

        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');

        if($fechas[0] == 'producto'){
            $respuesta = DB::select("CALL get_reporte_venta_by_date ('".$fechas[1]."','".$fechas[2]."')");
            if($fechas[1] == $fechas[2]){
                $cabecera = "Ventas del dia ".$fechas[1];
            }else{
                $cabecera = "Ventas desde ".$fechas[1]." al ".$fechas[2];
            }
            $pdf = PDF::loadView('inventario/pdf_ventas_producto',compact('respuesta','fecha','cabecera'));

        }else if($fechas[0] == 'detalle'){
            $respuesta = DB::select("CALL get_reporte_venta_by_date_2 ('".$fechas[1]."','".$fechas[2]."')");
            if($fechas[1] == $fechas[2]){
                $cabecera = "Ventas del dia ".$fechas[1];
            }else{
                $cabecera = "Ventas desde ".$fechas[1]." al ".$fechas[2];
            }
            $pdf = PDF::loadView('inventario/pdf_ventas_detalle',compact('respuesta','fecha','cabecera'));
        }

        return $pdf->download();
    }
    public function solicitud_repo(){
        return view('inventario\solicitud_repo');
    }
    public function guardar_solicitud_repo(Request $request){
        return dd($request);
    }
}
