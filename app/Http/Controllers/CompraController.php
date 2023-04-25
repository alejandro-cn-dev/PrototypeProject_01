<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra_cabecera;
use App\Models\Compra_detalle;
use App\Models\Producto;
use App\Models\Proveedor;
use PDF;

class CompraController extends Controller
{
    private $tabla_salidas = [];
    private $fila = 0;
    private $total = 0;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra_cabecera::join('proveedors','compra_cabeceras.id_proveedor','=','proveedors.id')
        ->select('compra_cabeceras.id','proveedors.nombre as proveedor','compra_cabeceras.monto_total','compra_cabeceras.fecha_compra')
        ->where('compra_cabeceras.isEnable','=',1)
        ->get();
        return view('compra.index')->with('compras',$compras);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::where('isEnable','=',1)->get();
        //$proveedores = Proveedor::where('isEnable','=',1)->get();
        $proveedores = Proveedor::all();
        return view('compra.create')->with('productos',$productos)->with('proveedores',$proveedores);
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
        $compras = Compra_cabecera::find($id);
        $denominacion = array(array('id'=>"recibo",'value'=>"Recibo"),array("id"=>"factura","value"=>"Factura"),array("id"=>"nota de venta","value"=>"Nota de venta"));        
        return view('compra.edit')->with('compra',$compras)->with('denominacion',$denominacion);
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
        $cabecera = Compra_cabecera::find($id);
        $cabecera->nit_ci = $request->get('nit_ci');
        $cabecera->id_proveedor = $request->get('id_proveedor');
        $cabecera->fecha_compra = $request->get('fecha_compra');
        //$cabecera->fecha_emision = $request->get('fecha_emision');
        $cabecera->save();

        return redirect('/compras');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Anulando cabecera
        $entrada = Compra_cabecera::find($id);
        $entrada->isEnable = false;
        $entrada->save();

        //Anulando registros de venta
        $affectedRows = Compra_detalle::where("id_compra", $id)->update(["isEnable" => 0]);
        return redirect('/compras');
    }

    //Funciones propias
    public function detalle($id){
        $entrada = Compra_detalle::where('id_compra','=',$id)->get();
        $cabecera = Compra_cabecera::find($id);
        $productos = Producto::all();
        return view('compra.detalle_compra')->with('cabecera',$cabecera)->with('compras',$entrada)->with('productos',$productos);
    }
    public function agregar(Request $request){
        $validator = \Validator::make($request->all(), [
            'producto'          => 'required',
            'precio_compra'      => 'required',
            'unidad_compra'      => 'required',
            'cantidad'          => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $last_id_cabecera = Compra_cabecera::latest('id')->first();
        
        //$this->fila = $this->fila + 1;
        
        array_push($this->tabla_salidas,array(
            //"id" => $this->fila, 
            "producto" => $request->producto, 
            "precio_compra" => $request->precio_compra, 
            "unidad_compra" => $request->unidad_compra, 
            "cantidad" => $request->cantidad            
        ));
        //return response()->json(['success'=>'Data is successfully added']);
        return response()->json(['success'=>$this->tabla_salidas]);
    }
    public function anular($id){
        unset($this->tabla_salidas[$id-1]);
    }
    public function addValor($valor){
        array_push($this->tabla_salidas,$valor);
    }
    public function deleteProducto($id){
        unset($this->tabla_salidas[$id]);
    }
    public function reporte(){
        $compras = Compra_cabecera::where('isEnable','=',1)->get();
        $total = Compra_cabecera::where('isEnable','=',1)->sum('monto_total');
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('compra/pdf_compra',compact('compras','total','fecha'));
        return $pdf->download('compras_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('compra/pdf_entrada',compact('entradas','total','fecha'));
    }
    public function reporte_ind($id){
        $cabecera = Compra_cabecera::find($id);
        $compras = Compra_detalle::where('id_compra','=',$id)->get();
        $productos = Producto::where('isEnable','=',1)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('compra/pdf_compra_ind',compact('cabecera','entradas','productos','fecha'));
        return $pdf->download('compra_nro_'.$id.'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('salida/pdf_salida',compact('entradas','total','fecha'));
    }
    public function guardar(Request $request){
        $total = 0;
        // $validator = \Validator::make($request->all(), [
        //     'id_proveedor'          => 'required',
        //     'fecha_compra'            => 'required',
        // ]);
        // if ($validator->fails())
        // {
        //     return response()->json(['errors'=>$validator->errors()->all()]);
        // }
        //Sumar total
        $filas_tabla = json_decode($request->tabla);
        
        foreach($filas_tabla as $fila){
            $total = $total + (($fila->precio_compra)*($fila->cantidad));
        }

        //Proceso
        $cabecera = new Compra_cabecera();
        //$cabecera->nit_ci = $request->nit_ci;
        $cabecera->id_proveedor = $request->id_proveedor;
        $cabecera->fecha_compra = $request->fecha_compra;
        $cabecera->monto_total = $total;
        $cabecera->save();
        
        $filas_tabla = json_decode($request->tabla);

        foreach($filas_tabla as $fila){            
            $entrada = new Compra_detalle();
            //$producto = Producto::where('descripcion','=',$fila->producto)->first();  
            $entrada->id_compra = $cabecera->id;      
            $entrada->costo_compra = $fila->precio_compra;   // Añadir variable a la tabla
            $entrada->cantidad = $fila->cantidad;
            $entrada->id_producto = $fila->producto;
            $entrada->save();
        }


        return response()->json(['success'=>'Data is successfully added']);
        return response()->json(['success'=>$filas_tabla]);
    }
}
