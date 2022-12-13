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
        $productos = Producto::where('isEnable','=',1)->get();
        return view('salida.create')->with('productos',$productos);
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
        //return redirect('/salidas');
        //return redirect('/salidas');
        // $request->validate([
        //     'producto'          => 'required',
        //     'unidad_venta'      => 'required',
        //     'precio_venta'      => 'required',
        //     'cantidad'          => 'required',
        // ]);
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

        // $salida = new Inventario();
        // $producto = Producto::where('descripcion','=',$request->producto)->first();        
        // $salida->id_producto = $producto->id;
        // $salida->id_cabecera = $last_id_cabecera->id;
        // //$salida->id_producto = $request->producto;
        // $salida->unidad = $request->unidad_venta;
        // $salida->precio = $request->precio_venta;
        // $salida->cantidad = $request->cantidad;
        // $salida->fecha = '2022-12-07 03:58:19';
        // $salida->save();

        
        $this->fila = $this->fila + 1;
        // //$fila_actual = array($fila => array("id" => $fila, "producto" => $request->input('id_producto'), "unidad" => $request->input('unidad_venta'), "precio" => $request->input('precio_venta')));
        array_push($this->tabla_salidas,array(
            "id" => $this->fila, 
            "producto" => $request->producto, 
            "unidad" => $request->unidad_venta, 
            "precio" => $request->precio_venta, 
            "cantidad" => $request->cantidad
            // "producto" => $request->input('producto'), 
            // "unidad" => $request->input('unidad_venta'), 
            // "precio" => $request->input('precio_venta'), 
            // "cantidad" => $request->input('cantidad')
        ));
        //array_push($tabla_salidas,$fila_actual);
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
    public function report(){
        $salidas = Inventario::where('tipo','=','S')->get();
        $pdf = PDF::loadView('pdf_salida',compact($salidas));
        return $pdf->download('salidas.pdf');
    }
    public function guardar(Request $request){
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
        
        //Proceso
        $salidas = Cabecera::all();
        //return view('salida.index')->with('salidas',$salidas)->with('prueba',$this->tabla_salidas);
        $cabecera = new Cabecera();
        $cabecera->denominacion = $request->denominacion;
        $cabecera->numeracion = $request->numeracion;
        $cabecera->num_autorizacion = $request->num_autorizacion;
        $cabecera->nombre = $request->nombre;
        $cabecera->nit_ci = $request->nit_razon_social;
        $cabecera->fecha_emision = $request->fecha_emision;
        $cabecera->tipo = 'S';
        $cabecera->monto_total = $this->total;
        $cabecera->save();
        
        $filas_tabla = json_decode($request->tabla);

        foreach($filas_tabla as $fila){
            // $salidas = new Inventario();
            // $salidas->id_cabecera = $cabecera->id;
            // $salidas->id_producto = 1;
            // $salidas->unidad = $fila->unidad;
            // $salidas->precio = $fila->precio;
            // $salidas->fecha = $request->get('fecha_emision');
            // $salidas->cantidad = $fila->cantidad;
            // $salidas->save();

            $salida = new Inventario();
            $producto = Producto::where('descripcion','=',$fila->producto)->first();        
            $salida->id_producto = $producto->id;
            $salida->id_cabecera = $cabecera->id;
            //$salida->id_producto = $request->producto;
            $salida->unidad = $fila->unidad_venta;
            $salida->precio = $fila->precio_venta;
            $salida->fecha = $request->get('fecha_emision');
            $salida->cantidad = $fila->cantidad;
            $salida->save();
        }


        //return response()->json(['success'=>'Data is successfully added']);
        return response()->json(['success'=>$filas_tabla]);
    }
}
