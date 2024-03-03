<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta_cabecera;
use App\Models\Venta_detalle;
use App\Models\Producto;
use App\Models\Cliente;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    private $tabla_salidas = [];
    private $fila = 0;
    private $total = 0;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:ventas.index')->only('index');
        $this->middleware('can:ventas.create')->only('create','store');
        $this->middleware('can:ventas.edit')->only('edit','update');
        $this->middleware('can:ventas.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta_cabecera::where('isDeleted','=',0)->get();
        $ventas = Venta_cabecera::join('clientes','venta_cabeceras.id_cliente','=','clientes.id')
        ->join('users','venta_cabeceras.id_usuario','=','users.id')
        ->select('venta_cabeceras.id','venta_cabeceras.numeracion','clientes.nombre as nombre','users.name as usuario','venta_cabeceras.monto_total')
        ->where('venta_cabeceras.isDeleted','=',0)->get();
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
        $productos = Producto::where('isDeleted','=',0)->get();
        $clientes = Cliente::all();
        $fecha_actual = date('Y-m-d', strtotime(Carbon::now()));
        return view('venta.create')->with("productos",$productos)->with("clientes",$clientes)->with("fecha_actual",$fecha_actual);
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
        // $denominacion = array(array('id'=>"recibo",'value'=>"Recibo"),array("id"=>"factura","value"=>"Factura"),array("id"=>"nota de venta","value"=>"Nota de venta"));
        return view('venta.edit')->with('venta',$ventas);
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
        $salida->isDeleted = true;
        $salida->save();

        //Anulando registros de venta
        $affectedRows = Venta_detalle::where("id_venta", $id)->update(["isDeleted" => true]);
        $response = array(
            'status' => 'success',
            'msg' => 'listo',
        );
        return response()->json($response);
        //return redirect('/ventas');
    }

    //Funciones propias
    public function detalle($id){
        $ventas = Venta_detalle::where('id_venta','=',$id)->get();
        $cabecera = Venta_cabecera::join('clientes','venta_cabeceras.id_cliente','=','clientes.id')
        ->join('users','venta_cabeceras.id_usuario','=','users.id')
        ->select('venta_cabeceras.id','venta_cabeceras.numeracion','clientes.nombre','clientes.ci','users.ap_paterno','users.ap_materno','users.name','venta_cabeceras.created_at as fecha_emision','venta_cabeceras.monto_total')
        ->where('venta_cabeceras.id','=',$id)->first();
        $productos = Producto::all();
        return view('venta.detalle_venta')->with('cabecera',$cabecera)->with('salidas',$ventas)->with('productos',$productos);
    }
    public function agregar(Request $request){
        // reglas de validación
        $rules = [
            'producto'      => 'required',
            'unidad'        => 'required',
            'precio_venta'  => 'required',
            'cantidad'      => 'required'
        ];
        // Mensajes de error personalizados
        $custom_messages = [
            'producto.required' => 'Debe escojer un producto',
            'unidad.required' => 'Debe detallar la unidad de medida',
            'precio_venta.required' => 'Debe especificar el precio',
            'cantidad.required' => 'Debe especificar la cantidad'
        ];
        // Validacion de Request
        $validator = $this->validate($request,$rules,$custom_messages);
        // Consulta de stock disponible
        $id_producto = json_decode($request->producto);
        DB::select("CALL get_stock_by_productid (".$id_producto->id.", @p1)");
        $existencias = DB::select('select @p1 as stock');
        return response()->json(['existencias' => $existencias]);
    }
    public function reporte(){
        //$salidas = Venta_cabecera::where('isDeleted','=',0)->get();
        $salidas = Venta_cabecera::join('clientes','venta_cabeceras.id_cliente','=','clientes.id')
        ->join('users','venta_cabeceras.id_usuario','=','users.id')
        ->select('venta_cabeceras.id','venta_cabeceras.numeracion','clientes.nombre','clientes.ci','users.name','venta_cabeceras.created_at as fecha_emision','venta_cabeceras.monto_total')
        ->where('venta_cabeceras.isDeleted','=',0)
        ->get();
        $total = Venta_cabecera::where('isDeleted','=',0)->sum('monto_total');

        //Conseguir fecha actual y brindarle formato
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $fecha_actual = Carbon::now();
        $mes = $meses[($fecha_actual->format('n')) - 1];
        $dia = $dias[$fecha_actual->format('w')];
        $fecha = $dia . ', '.$fecha_actual->format('d') . ' de ' . $mes . ' de ' . $fecha_actual->format('Y');

        $pdf = PDF::loadView('venta/pdf_venta',compact('salidas','total','fecha'));
        return $pdf->download('reporte_ventas_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('venta/pdf_salida',compact('salidas','total','fecha'));
    }
    public function reporte_ind($id){
        $cabecera = Venta_cabecera::join('clientes','venta_cabeceras.id_cliente','=','clientes.id')
        ->join('users','venta_cabeceras.id_usuario','=','users.id')
        ->select('venta_cabeceras.id','venta_cabeceras.numeracion','clientes.nombre','clientes.ci','users.name','venta_cabeceras.created_at as fecha_emision','venta_cabeceras.monto_total')
        ->where('venta_cabeceras.id','=',$id)->first();
        $salidas = Venta_detalle::where('id_venta','=',$id)->get();
        $productos = Producto::where('isDeleted','=',0)->get();
        $fecha_actual = date_create(date('d-m-Y'));

        //Conseguir fecha actual y brindarle formato
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $fecha_actual = Carbon::now();
        $mes = $meses[($fecha_actual->format('n')) - 1];
        $dia = $dias[$fecha_actual->format('w')];
        $fecha = $dia . ', '.$fecha_actual->format('d') . ' de ' . $mes . ' de ' . $fecha_actual->format('Y');

        $pdf = PDF::loadView('venta/pdf_venta_ind',compact('cabecera','salidas','productos','fecha'));
        return $pdf->download('venta_nro_'.$id.'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('venta/pdf_salida',compact('salidas','total','fecha'));
    }
    public function nota_ind($id){
        $cabecera = Venta_cabecera::join('clientes','venta_cabeceras.id_cliente','=','clientes.id')
        ->join('users','venta_cabeceras.id_usuario','=','users.id')
        ->select('venta_cabeceras.id','venta_cabeceras.numeracion','clientes.ci','clientes.nombre','clientes.telefono','clientes.direccion','clientes.ci','users.name','venta_cabeceras.created_at as fecha_emision','venta_cabeceras.monto_total')
        ->where('venta_cabeceras.id','=',$id)->first();
        $salidas = Venta_detalle::where('id_venta','=',$id)->get();
        $productos = Producto::where('isDeleted','=',0)->get();
        $fecha_actual = date_create(date('d-m-Y'));

        // Para conseguir fecha en español
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $fecha = Carbon::parse($cabecera->fecha_emision);
        $mes = $meses[($fecha->format('n')) - 1];
        $dia = $dias[$fecha->format('w')];
        $fecha_nota = $dia . ', '.$fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');

        $pdf = PDF::loadView('venta/pdf_nota_venta',compact('cabecera','salidas','productos','fecha_nota'));
        return $pdf->download('nota_venta_nro_'.str_pad($cabecera->numeracion, 8, '0', STR_PAD_LEFT).'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
    }
    public function guardar(Request $request){
        $fecha = '';
        $cliente_identi = '';
        //Sumar total
        $total = 0;
        $filas_tabla = json_decode($request->tabla);

        foreach($filas_tabla as $fila){
            $total = $total + (($fila->precio_venta)*($fila->cantidad));
        }

        //Proceso
        //Insertar cliente
        $verificar_ci = Cliente::where('ci','=',$request->ci)->first();
        if(($verificar_ci) == null){
            $cliente = new Cliente();
            $cliente->nombre = $request->nombre;
            $cliente->ci = $request->ci;
            $cliente->telefono = $request->telefono;
            $cliente->email = $request->email;
            $cliente->direccion = $request->direccion;
            $cliente->save();
            $cliente_identi = $cliente->id;
        }else{
            $verificar_ci->nombre = $request->nombre;
            $verificar_ci->telefono = $request->telefono;
            $verificar_ci->email = $request->email;
            $verificar_ci->direccion = $request->direccion;
            $verificar_ci->save();
            $cliente_identi = $verificar_ci->id;
        }


        //insertar cabecera
        $cabecera = new Venta_cabecera();
        //$cabecera->numeracion = $numero_nota_venta;
        // Obtener último número de nota de venta
        $last = Venta_cabecera::max('numeracion');
        $cabecera->numeracion = $last + 1;
        $cabecera->id_cliente = $cliente_identi;
        $cabecera->id_usuario = auth()->user()->id;
        $cabecera->monto_total = $total;
        // Si no se introdujo ninguna fecha, se establece la fecha actual
        if(empty($request->fecha_venta)){
            $fecha = date('Y-m-d', strtotime(Carbon::now()));
        }else{
            $fecha = $request->fecha_venta;
        }
        $cabecera->fecha_venta = $fecha;
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
    public function clientes(){
        $clientes = Cliente::all();
        return view('venta.clientes')->with('clientes',$clientes);
    }
    public function getClientes(Request $request){
        $cliente = Cliente::where('ci','LIKE',$request->ci.'%')->take(10)->get();
        return response()->json(['cliente'=>$cliente]);
    }
}
