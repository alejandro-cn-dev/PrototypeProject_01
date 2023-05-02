<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta_cabecera;
use App\Models\Venta_detalle;
use App\Models\Producto;
use App\Models\Cliente;
use PDF;

class VentaController extends Controller
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
        $ventas = Venta_cabecera::where('isEnable','=',1)->get();
        $ventas = Venta_cabecera::join('clientes','venta_cabeceras.id_cliente','=','clientes.id')
        ->join('users','venta_cabeceras.id_usuario','=','users.id')
        ->select('venta_cabeceras.id','venta_cabeceras.numeracion','clientes.nombre as nombre','users.name as usuario','venta_cabeceras.monto_total')
        ->where('venta_cabeceras.isEnable','=',1)->get();
        return view('venta.index')->with('ventas',$ventas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$ventas = Venta_cabecera::where('tipo','=','S')->get();
        $productos = Producto::where('isEnable','=',1)->get();
        return view('venta.create')->with("productos",$productos);
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
        $ventas = Venta_cabecera::find($id);
        $denominacion = array(array('id'=>"recibo",'value'=>"Recibo"),array("id"=>"factura","value"=>"Factura"),array("id"=>"nota de venta","value"=>"Nota de venta"));        
        return view('venta.edit')->with('venta',$ventas)->with('denominacion',$denominacion);
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
        $cabecera = Venta_cabecera::find($id);
        $cabecera->denominacion = $request->get('denominacion');
        $cabecera->numeracion = $request->get('numeracion');
        $cabecera->num_autorizacion = $request->get('num_autorizacion');
        $cabecera->nombre = $request->get('nombre');
        $cabecera->nit_ci = $request->get('nit_ci');
        $cabecera->fecha_emision = $request->get('fecha_emision');
        $cabecera->save();

        return redirect('/ventas');
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
        $salida = Venta_cabecera::find($id);
        $salida->isEnable = false;
        $salida->save();

        //Anulando registros de venta
        $affectedRows = Venta_detalle::where("id_cabecera", $id)->update(["isEnable" => 0]);
        return redirect('/ventas');
    }

    //Funciones propias
    public function detalle($id){
        $ventas = Venta_detalle::where('id_venta','=',$id)->get();
        $cabecera = Venta_cabecera::join('clientes','venta_cabeceras.id_cliente','=','clientes.id')
        ->join('users','venta_cabeceras.id_usuario','=','users.id')
        ->select('venta_cabeceras.id','venta_cabeceras.numeracion','clientes.nombre','clientes.ci','users.name','venta_cabeceras.created_at as fecha_emision','venta_cabeceras.monto_total')
        ->where('venta_cabeceras.id','=',$id)->first();
        $productos = Producto::all();
        return view('venta.detalle_venta')->with('cabecera',$cabecera)->with('salidas',$ventas)->with('productos',$productos);        
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
        $ventas = Venta_cabecera::where('isEnable','=',1)->get();
        $total = Venta_cabecera::where('isEnable','=',1)->sum('monto_total');
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('venta/pdf_venta',compact('ventas','total','fecha'));
        return $pdf->download('ventas_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('venta/pdf_salida',compact('salidas','total','fecha'));
    }
    public function reporte_ind($id){
        $cabecera = Venta_cabecera::find($id);
        $ventas = Venta_detalle::where('id_cabecera','=',$id)->get();
        $productos = Producto::where('isEnable','=',1)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('venta/pdf_salida_ind',compact('cabecera','ventas','productos','fecha'));
        return $pdf->download('venta_nro_'.$id.'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('venta/pdf_salida',compact('salidas','total','fecha'));
    }
    public function guardar(Request $request){
        $total = 0;
        //Sumar total
        $filas_tabla = json_decode($request->tabla);
        
        foreach($filas_tabla as $fila){
            $total = $total + (($fila->precio_venta)*($fila->cantidad));
        }

        //Proceso
        //Insertar cliente
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->ci = $request->ci;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->direccion = $request->direccion;        
        $cliente->save();

        //insertar cabecera
        $cabecera = new Venta_cabecera();
        //$cabecera->numeracion = $numero_nota_venta;
        $cabecera->numeracion = '920129127';
        $cabecera->id_cliente = $cliente->id;
        $cabecera->id_usuario = auth()->user()->id;
        $cabecera->monto_total = $total;
        $cabecera->save();

        //insertar detalle
        foreach($filas_tabla as $fila){
            $salida = new Venta_detalle();
            //$producto = Producto::where('descripcion','=',$fila->producto)->first();
            $salida->id_venta = $cabecera->id;
            $salida->precio_unitario = $fila->precio_venta;
            $salida->cantidad = $fila->cantidad;        
            $salida->id_producto = $fila->producto;
            $salida->save();
        }


        return response()->json(['success'=>'Data is successfully added']);
        //return response()->json(['success'=>$filas_tabla]);
    }
}
