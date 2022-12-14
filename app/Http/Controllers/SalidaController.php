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
        $salidas = Cabecera::where('tipo','=','S')->get();
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
        return view('salida.edit')->with('salidas',$salidas);
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
        $cabecera = new Cabecera();
        $cabecera->denominacion = $request->get('denominacion');
        $cabecera->numeracion = $request->get('numeracion');
        $cabecera->num_autorizacion = $request->get('num_autorizacion');
        $cabecera->nombre = $request->get('nombre');
        $cabecera->nit_ci = $request->get('nit_ci');
        $cabecera->fecha_emision = $request->get('fecha_emision');
        $cabecera->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salida = Cabecera::find($id);
        $salida->isEnable = false;
        $salida->save();
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
        $last_id_cabecera = Cabecera::latest('id')->first();
        
        $this->fila = $this->fila + 1;
        // //$fila_actual = array($fila => array("id" => $fila, "producto" => $request->input('id_producto'), "unidad" => $request->input('unidad_venta'), "precio" => $request->input('precio_venta')));
        array_push($this->tabla_salidas,array(
            "id" => $this->fila, 
            "producto" => $request->producto, 
            "unidad" => $request->unidad_venta, 
            "precio" => $request->precio_venta, 
            "cantidad" => $request->cantidad
        ));
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
        $total = Cabecera::sum('monto_total');
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
            'nit_razon_social'      => 'required',
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
        $cabecera->num_autorizacion = $request->num_autorizacion;
        $nombre = $request->nombre;
        if(empty($nombre)){
            $nombre = "(Sin nombre)";
        }
        $cabecera->nombre = $nombre;
        $cabecera->nit_ci = $request->nit_razon_social;
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
