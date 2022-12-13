<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabecera;
use App\Models\Inventario;
use App\Models\Producto;

class EntradaController extends Controller
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
        $entradas = Cabecera::where('tipo','=','E');
        return view('entrada.index')->with('entradas',$entradas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::where('isEnable','=',1)->get();
        return view('entrada.create')->with('productos',$productos);
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
        $entradas = Cabecera::find($id);
        return view('entrada.edit')->with('entradas',$entradas);
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
        $entrada = Cabecera::find($id);
        $entrada->isEnable = false;
        $entrada->save();
        return redirect('/entradas');
    }

    //Funciones propias
    public function detalle($id){
        $entrada = Inventario::where('id_cabecera','=',$id)->get();
        $cabecera = Cabecera::find($id);
        $productos = Producto::all();
        return view('entrada.detalle_entrada')->with('cabecera',$cabecera)->with('entradas',$entrada)->with('productos',$productos);
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
        $last_id_cabecera = Cabecera::latest('id')->first();
        
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
    public function report(){
        $salidas = Inventario::where('tipo','=','S')->get();
        // $data = [
        //     'title' => 'Welcome to System',
        //     'date' => date('m/d/Y'),
        //     'salidas' => $salidas
        // ];
        // $pdf = PDF::loadView('myPDF',$data);
        // $pdf = app('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->download('examplePDF.pdf');
        return PDF::loadView('/salidas',$salidas)->stream('archivo.pdf');
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
        
        $cabecera = new Cabecera();
        $cabecera->denominacion = $request->denominacion;
        $cabecera->numeracion = $request->numeracion;
        $cabecera->num_autorizacion = $request->num_autorizacion;
        $cabecera->nombre = $request->nombre;
        $cabecera->nit_ci = $request->nit_razon_social;
        $cabecera->fecha_emision = $request->fecha_emision;
        $cabecera->tipo = 'E';
        $cabecera->monto_total = $this->total;
        $cabecera->save();
        
        $filas_tabla = json_decode($request->tabla);

        foreach($filas_tabla as $fila){
            
            $entrada = new Inventario();
            $producto = Producto::where('descripcion','=',$fila->producto)->first();        
            //$entrada->id_producto = $producto->id;
            $entrada->id_producto = 1;
            $entrada->id_cabecera = $cabecera->id;
            $entrada->unidad = $fila->unidad_compra;
            $entrada->precio = $fila->precio_compra;
            $entrada->fecha = $request->get('fecha_emision');
            $entrada->cantidad = $fila->cantidad;
            $entrada->save();
        }


        //return response()->json(['success'=>'Data is successfully added']);
        return response()->json(['success'=>$filas_tabla]);
    }
}
