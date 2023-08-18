<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra_detalle;
use App\Models\Venta_detalle;
use App\Models\Compra_cabecera;
use App\Models\Venta_cabecera;
use App\Models\Producto;
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
        ->select('id_venta AS id_cabecera','precio_unitario AS costo','cantidad','id_producto','venta_detalles.created_at','productos.nombre','productos.item_producto',DB::raw("'salida' AS tipo"))
        ->where('venta_detalles.isDeleted','=',0);
        $inventario = Compra_detalle::join('productos','compra_detalles.id_producto','=','productos.id')
        ->select('id_compra AS id_cabecera','costo_compra AS costo','cantidad','id_producto','compra_detalles.created_at','productos.nombre','productos.item_producto',DB::raw("'entrada' AS tipo"))
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
        ->select('productos.id','productos.item_producto','productos.nombre','categorias.detalle AS categoria','marcas.detalle AS marca','productos.color','productos.unidad','productos.precio_compra','productos.precio_venta',DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM compra_detalles WHERE id_producto = productos.id) - (SELECT COALESCE(SUM(cantidad),0) FROM venta_detalles WHERE id_producto = productos.id)) AS existencias"))
        ->where('productos.isDeleted','=',0)->get();
        return view('inventario.existencias')->with('productos',$productos);
    }
    public function get_movimientos(Request $request)
    {
        $ventas = Venta_detalle::join('productos','venta_detalles.id_producto','=','productos.id')
        ->select('id_venta AS id_cabecera','precio_unitario AS costo','cantidad','id_producto','venta_detalles.created_at','productos.nombre','productos.item_producto',DB::raw("'salida' AS tipo"))
        ->where('venta_detalles.isDeleted','=',0);
        $inventario = Compra_detalle::join('productos','compra_detalles.id_producto','=','productos.id')
        ->select('id_compra AS id_cabecera','costo_compra AS costo','cantidad','id_producto','compra_detalles.created_at','productos.nombre','productos.item_producto',DB::raw("'entrada' AS tipo"))
        ->where('compra_detalles.isDeleted','=',0)
        ->union($ventas)->get();
        $respuesta = $inventario;
        if($request->criterio == 'ventas'){
            $respuesta = Venta_detalle::join('productos','venta_detalles.id_producto','=','productos.id')
            ->select('id_venta AS id_cabecera','precio_unitario AS costo','cantidad','id_producto','venta_detalles.created_at','productos.nombre','productos.item_producto',DB::raw("'salida' AS tipo"))
            ->where('venta_detalles.isDeleted','=',0)
            ->get();
        }
        if($request->criterio == 'compras'){
            $respuesta = Compra_detalle::join('productos','compra_detalles.id_producto','=','productos.id')
            ->select('id_compra AS id_cabecera','costo_compra AS costo','cantidad','id_producto','compra_detalles.created_at','productos.nombre','productos.item_producto',DB::raw("'entrada' AS tipo"))
            ->where('compra_detalles.isDeleted','=',0)
            ->get();
        }
        return response()->json(['respuesta'=>$respuesta]);
    }
    public function stock()
    {
        $productos = Producto::select('nombre','item_producto','precio_compra','precio_venta',DB::raw("(SELECT SUM(cantidad) FROM compra_detalles WHERE id_producto = productos.id) AS entradas"),DB::raw("(SELECT SUM(cantidad) FROM venta_detalles WHERE id_producto = productos.id) AS salidas"))
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
        $consulta_compras = str_replace(array("|fechainicio",":fechafinal"),array($request->fecha_inicial,$request->fecha_final),"(SELECT SUM(compra_detalles.cantidad) FROM compra_cabeceras INNER JOIN compra_detalles ON compra_cabeceras.id = compra_detalles.id_compra WHERE (compra_detalles.id_producto = productos.id) AND (compra_cabeceras.fecha_compra BETWEEN '|fechainicio' AND ':fechafinal')) AS entradas");
        $consulta_ventas = str_replace(array("|fechainicio",":fechafinal"),array($request->fecha_inicial,$request->fecha_final),"(SELECT SUM(venta_detalles.cantidad) FROM venta_cabeceras INNER JOIN venta_detalles ON venta_cabeceras.id = venta_detalles.id_venta WHERE (venta_detalles.id_producto = productos.id) AND (venta_cabeceras.fecha_venta BETWEEN '|fechainicio' AND ':fechafinal')) AS salidas");
        $respuesta = Producto::select(
            'nombre',
            'item_producto',
            'precio_compra',
            'precio_venta',
            DB::raw($consulta_compras),
            DB::raw($consulta_ventas))
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
        $productos = Producto::select('nombre','item_producto','precio_compra','precio_venta',DB::raw("(SELECT SUM(cantidad) FROM compra_detalles WHERE id_producto = productos.id) AS entradas"),DB::raw("(SELECT SUM(cantidad) FROM venta_detalles WHERE id_producto = productos.id) AS salidas"))
        ->where('isDeleted','=',0)
        ->get();

        return view('inventario.control_stock')->with('productos',$productos);
    }
}
