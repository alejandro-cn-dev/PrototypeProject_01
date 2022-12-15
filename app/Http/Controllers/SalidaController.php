<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabecera;
use App\Models\Inventario;
use App\Models\Producto;
use PDF;

class SalidaController extends Controller
{    
    private $tabla_salidas = [];
    private $fila = 0;
    private $total = 0;

    // public function __construct(){        
    //     $this->tabla_salidas = [];
    //     $this->fila = 0;
    //     $this->total = 0;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salidas = Cabecera::where('tipo','=','S')->where('isEnable','=',1)->get();
        return view('salida.index')->with('salidas',$salidas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salidas = Cabecera::where('tipo','=','S')->get();
        $productos = Producto::where('isEnable','=',1)->get();
        return view('salida.create')->with('salidas',$salidas)->with("productos",$productos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        //return redirect('/salidas');
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
        $salidas = Cabecera::find($id);
        $denominacion = array(array('id'=>"recibo",'value'=>"Recibo"),array("id"=>"factura","value"=>"Factura"),array("id"=>"nota de venta","value"=>"Nota de venta"));        
        return view('salida.edit')->with('salida',$salidas)->with('denominacion',$denominacion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Respons
     * e
     */
    public function update(Request $request, $id)
    {
        $cabecera = Cabecera::find($id);
        $cabecera->denominacion = $request->get('denominacion');
        $cabecera->numeracion = $request->get('numeracion');
        $cabecera->num_autorizacion = $request->get('num_autorizacion');
        $cabecera->nombre = $request->get('nombre');
        $cabecera->nit_ci = $request->get('nit_ci');
        $cabecera->fecha_emision = $request->get('fecha_emision');
        $cabecera->save();

        return redirect('/salidas');
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
        $salida = Cabecera::find($id);
        $salida->isEnable = false;
        $salida->save();

        //Anulando registros de venta
        $affectedRows = Inventario::where("id_cabecera", $id)->update(["isEnable" => 0]);
        return redirect('/salidas');
    }

    //Funciones propias
    public function detalle($id){
        $salidas = Inventario::where('id_cabecera','=',$id)->get();
        $cabecera = Cabecera::find($id);
        $productos = Producto::all();
        return view('salida.detalle_salida')->with('cabecera',$cabecera)->with('salidas',$salidas)->with('productos',$productos);
    }
    public function agregar(Request $request){
        $validator = \Validator::make($request->all(), [
            'producto'          => 'required',
            'unidad_venta'      => 'required',
            'precio_venta'      => 'required',
            'cantidad'          => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        
        //proceso control de stock


        return response()->json(['success'=>'Data is successfully added']);
        //return response()->json(['success'=>$this->tabla_salidas]);
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
        $salidas = Cabecera::where('tipo','=','S')->where('isEnable','=',1)->get();
        $total = Cabecera::where('tipo','=','S')->where('isEnable','=',1)->sum('monto_total');
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('salida/pdf_salida',compact('salidas','total','fecha'));
        return $pdf->download('salidas_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('salida/pdf_salida',compact('salidas','total','fecha'));
    }
    public function reporte_ind($id){
        $cabecera = Cabecera::find($id);
        $salidas = Inventario::where('id_cabecera','=',$id)->get();
        $productos = Producto::where('isEnable','=',1)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('salida/pdf_salida_ind',compact('cabecera','salidas','productos','fecha'));
        return $pdf->download('salida_nro_'.$id.'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('salida/pdf_salida',compact('salidas','total','fecha'));
    }
    public function guardar(Request $request){
        $total = 0;
        $validator = \Validator::make($request->all(), [
            'denominacion'          => 'required',
            'numeracion'            => 'required',
            //'nombre'                => 'required',
            //'num_autorizacion'      => 'required',
            //'nit_razon_social'      => 'required',
            'fecha_emision'         => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        //Sumar total
        $filas_tabla = json_decode($request->tabla);
        
        foreach($filas_tabla as $fila){
            $total = $total + (($fila->precio_venta)*($fila->cantidad));
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
        $cabecera->fecha_emision = $request->fecha_emision;
        $cabecera->tipo = 'S';
        $cabecera->monto_total = $total;
        $cabecera->save();

        foreach($filas_tabla as $fila){
            $salida = new Inventario();
            $producto = Producto::where('descripcion','=',$fila->producto)->first();        
            $salida->id_producto = $producto->id;
            $salida->id_cabecera = $cabecera->id;
            $salida->unidad = $fila->unidad_venta;
            $salida->precio = $fila->precio_venta;
            $salida->fecha = $request->get('fecha_emision');
            $salida->cantidad = $fila->cantidad;
            $salida->save();
        }


        return response()->json(['success'=>'Data is successfully added']);
        //return response()->json(['success'=>$filas_tabla]);
    }
}
