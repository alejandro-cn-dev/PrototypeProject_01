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
use DB;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Funciones propias
     */
    public function existencias()
    {
        $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.nombre','categorias.detalle AS categoria','marcas.detalle AS marca','productos.color','productos.unidad','productos.precio_compra','productos.precio_venta',DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0)) - (SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE (id_producto = productos.id) AND (isDeleted = 0))) AS existencias"))
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
        $ventas = Venta_detalle::where('isDeleted','=',0)->get();

        return view('inventario.ventas')->with('ventas',$ventas);
        //return response()->json(['ventas'=>$ventas]);
    }
    public function reporte_ventas_criterio(Request $request)
    {     
        $ventas = DB::select("CALL get_reporte_venta_by_arg ('".$request->param."')");
        return response()->json(['respuesta'=>$ventas]);
    }
}
