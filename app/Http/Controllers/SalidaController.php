<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cabecera;
use App\Models\Inventario;
use App\Models\Producto;

class SalidaController extends Controller
{    
    protected $tabla_salidas = [];
    protected $filas = 0;
    protected $total = 0;
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
        $salidas = Cabecera::all();
        return view('salida.index')->with('salidas',$salidas)->with('prueba',$this->tabla_salidas);
        $cabecera = new Cabecera();
        $cabecera->denominacion = $request->get('denominacion');
        $cabecera->numeracion = $request->get('numeracion');
        $cabecera->num_autorizacion = $request->get('num_autorizacion');
        $cabecera->nombre = $request->get('nombre');
        $cabecera->nit_ci = $request->get('nit_razon_social');
        $cabecera->fecha_emision = $request->get('fecha_emision');
        $cabecera->tipo = 'S';
        $cabecera->monto_total = $this->total;
        $cabecera->save();
        
        foreach($this->tabla_salidas as $fila){
            $salidas = new Inventario();
            $salidas->id_cabecera = $cabecera->id;
            $salidas->id_producto = 1;
            $salidas->unidad = $fila->unidad;
            $salidas->precio = $fila->precio;
            $salidas->fecha = $request->get('fecha_emision');
            $salidas->cantidad = $fila->cantidad;
            $salidas->save();
        }
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
        //
    }

    //Funciones propias
    public function detalle($id){
        $salidas = Inventario::where('id_cabecera','=',$id)->get();
        $cabecera = Cabecera::find($id);
        $productos = Producto::all();
        return view('salida.detalle')->with('cabecera',$cabecera)->with('salidas',$salidas)->with('productos',$productos);
    }
    public function agregar(Request $request){
        return redirect('/salidas');
        // $request->validate([
        //     'producto'          => 'required',
        //     'unidad_venta'      => 'required',
        //     'precio_venta'      => 'required',
        //     'cantidad'          => 'required',
        // ]);

        $salida = new Inventario();
        $producto = Producto::where('descripcion','=',$request->producto)->first();
        $salida->id_producto = $producto->id;
        $salida->unidad_venta = $request->unidad_venta;
        $salida->precio_venta = $request->precio_venta;
        $salida->cantidad = $request->cantidad;
        $salida->save();
        // $fila = $fila + 1;
        // //$fila_actual = array($fila => array("id" => $fila, "producto" => $request->input('id_producto'), "unidad" => $request->input('unidad_venta'), "precio" => $request->input('precio_venta')));
        // array_push($this->tabla_salidas,array(
        //     "id" => $fila, 
        //     "producto" => $request->producto, 
        //     "unidad" => $request->unidad_venta, 
        //     "precio" => $request->precio_venta, 
        //     "cantidad" => $request->cantidad
        //     // "producto" => $request->input('producto'), 
        //     // "unidad" => $request->input('unidad_venta'), 
        //     // "precio" => $request->input('precio_venta'), 
        //     // "cantidad" => $request->input('cantidad')
        // ));
        //array_push($tabla_salidas,$fila_actual);
    }
    public function anular($id){
        unset($tabla_salidas[$id-1]);
    }
    public function addValor($valor){
        array_push($tabla_salidas,$valor);
    }
    public function deleteProducto($id){
        unset($tabla_salidas[$id]);
    }
}
