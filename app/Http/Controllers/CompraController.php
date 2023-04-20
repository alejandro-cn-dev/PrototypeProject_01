<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra_cabecera;
use App\Models\Compra_detalle;
use App\Models\Producto;
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
        $compras = Compra_cabecera::where('isEnable','=',1)->get();
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
        return view('compra.create')->with('productos',$productos);
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
        $cabecera->denominacion = $request->get('denominacion');
        $cabecera->numeracion = $request->get('numeracion');
        $cabecera->num_autorizacion = $request->get('num_autorizacion');
        $cabecera->nombre = $request->get('nombre');
        $cabecera->nit_ci = $request->get('nit_ci');
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
        $affectedRows = Compra_detalle::where("id_cabecera", $id)->update(["isEnable" => 0]);
        return redirect('/compras');
    }

    //Funciones propias
    public function detalle($id){
        $entrada = Compra_detalle::where('id_cabecera','=',$id)->get();
        $cabecera = Compra_cabecera::find($id);
        $productos = Producto::all();
        return view('compra.detalle_entrada')->with('cabecera',$cabecera)->with('compras',$entrada)->with('productos',$productos);
    }
    public function agregar(Request $request){
        $validator = \Validator::make($request->all(), [
            'producto'          => 'required',
            'unidad_compra'      => 'required',
            'precio_compra'      => 'required',
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
            "unidad" => $request->unidad_venta, 
            "precio" => $request->precio_venta, 
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
        $compras = Compra_detalle::where('id_cabecera','=',$id)->get();
        $productos = Producto::where('isEnable','=',1)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('compra/pdf_compra_ind',compact('cabecera','entradas','productos','fecha'));
        return $pdf->download('compra_nro_'.$id.'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('salida/pdf_salida',compact('entradas','total','fecha'));
    }
    public function guardar(Request $request){
        $total = 0;
        $validator = \Validator::make($request->all(), [
            'denominacion'          => 'required',
            'numeracion'            => 'required',
            //'nombre'                => 'required',
            //'num_autorizacion'      => 'required',
            // 'nit_razon_social'      => 'required',
            'fecha_emision'         => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        //Sumar total
        $filas_tabla = json_decode($request->tabla);
        
        foreach($filas_tabla as $fila){
            $total = $total + (($fila->precio_compra)*($fila->cantidad));
        }

        //Proceso
        $cabecera = new Cabecera();
        $cabecera->denominacion = $request->denominacion;
        $cabecera->numeracion = $request->numeracion;
        $num_autorizacion = $request->num_autorizacion;
        if(empty($num_autorizacion)){
            $num_autorizacion = "(Sin Nro Autorizacion)";
        }
        $cabecera->num_autorizacion = $num_autorizacion;
        $nombre = $request->nombre;
        if(empty($nombre)){
            $nombre = "(Sin nombre)";
        }
        $cabecera->nombre = $nombre;
        $nit = $request->nit_razon_social;
        if(empty($nit)){
            $nit = "(Sin NIT/CI)";
        }
        $cabecera->nit_ci = $nit;
        $cabecera->nit_ci = $request->nit_razon_social;
        $cabecera->fecha_emision = $request->fecha_emision;
        $cabecera->tipo = 'E';
        $cabecera->monto_total = $total;
        $cabecera->save();
        
        $filas_tabla = json_decode($request->tabla);

        foreach($filas_tabla as $fila){            
            $entrada = new Compra_detalle();
            $producto = Producto::where('descripcion','=',$fila->producto)->first();        
            $entrada->id_producto = $producto->id;
            $entrada->id_cabecera = $cabecera->id;
            $entrada->unidad = $fila->unidad_compra;
            $entrada->precio = $fila->precio_compra;
            $entrada->fecha = $request->get('fecha_emision');
            $entrada->cantidad = $fila->cantidad;
            $entrada->save();
        }


        return response()->json(['success'=>'Data is successfully added']);
        return response()->json(['success'=>$filas_tabla]);
    }
}
