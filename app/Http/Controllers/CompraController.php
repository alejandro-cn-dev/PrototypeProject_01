<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra_cabecera;
use App\Models\Compra_detalle;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    private $tabla_salidas = [];
    private $fila = 0;
    private $total = 0;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:compras.index')->only('index');
        $this->middleware('can:compras.create')->only('create','store');
        $this->middleware('can:compras.edit')->only('edit','update');
        $this->middleware('can:compras.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra_cabecera::join('proveedors','compra_cabeceras.id_proveedor','=','proveedors.id')
        ->select('compra_cabeceras.id','proveedors.nombre as proveedor','compra_cabeceras.monto_total','compra_cabeceras.fecha_compra')
        ->where('compra_cabeceras.isDeleted','=',0)
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
        $productos = Producto::select('productos.id','productos.nombre','productos.color','productos.medida','productos.calidad','productos.unidad','productos.precio_compra','productos.precio_venta','marcas.detalle AS marca')->join('marcas','productos.id_marca','=','marcas.id')->where('productos.isDeleted','=',0)->get();
        //$proveedores = Proveedor::where('isDeleted','=',1)->get();
        $proveedores = Proveedor::select('proveedors.id','proveedors.nombre','proveedors.telefono','marcas.detalle AS marca')
        ->join('marcas','proveedors.id_marca','=','marcas.id')->where('proveedors.isDeleted','=',0)->get();
        $fecha_actual = date('Y-m-d', strtotime(Carbon::now()));
        return view('compra.create')->with('productos',$productos)->with('proveedores',$proveedores)->with("fecha_actual",$fecha_actual);
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
        $proveedores = Proveedor::all();
        // $denominacion = array(array('id'=>"recibo",'value'=>"Recibo"),array("id"=>"factura","value"=>"Factura"),array("id"=>"nota de venta","value"=>"Nota de venta"));
        return view('compra.edit')->with('entrada',$compras)->with('proveedores',$proveedores);
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
        $entrada->isDeleted = true;
        $entrada->save();

        //Anulando registros de compra
        $affectedRows = Compra_detalle::where("id_compra", $id)->update(["isDeleted" => true]);

        $response = array(
            'status' => 'success',
            'msg' => 'listo',
        );
        return response()->json($response);
        //return redirect('/compras');
    }

    //Funciones propias
    public function detalle($id){
        $entrada = Compra_detalle::where('id_compra','=',$id)->get();
        $cabecera = Compra_cabecera::find($id);
        $productos = Producto::all();
        $proveedor = Proveedor::find($cabecera->id_proveedor);
        //$usuario = User::where('id_user','=',($cabecera->id_usuario))->first();
        $usuario = User::find($cabecera->id_usuario);
        return view('compra.detalle_compra')
        ->with('cabecera',$cabecera)
        ->with('compras',$entrada)
        ->with('productos',$productos)
        ->with('proveedor',$proveedor)
        ->with('usuario',$usuario);
    }
    public function agregar(Request $request){
        $validator = Validator::make($request->all(), [
            'producto'          => 'required',
            'precio_compra'      => 'required',
            'unidad'      => 'required',
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
            "unidad" => $request->unidad,
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
        $compras = Compra_cabecera::join('proveedors','compra_cabeceras.id_proveedor','=','proveedors.id')
        ->select('compra_cabeceras.id','proveedors.nombre as proveedor','compra_cabeceras.monto_total','compra_cabeceras.fecha_compra')
        ->where('compra_cabeceras.isDeleted','=',0)
        ->get();
        $total = Compra_cabecera::where('isDeleted','=',0)->sum('monto_total');
        $proveedor = Proveedor::all();
        $fecha_actual = date_create(date('d-m-Y'));

        //Conseguir fecha actual y brindarle formato
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $fecha_actual = Carbon::now();
        $mes = $meses[($fecha_actual->format('n')) - 1];
        $dia = $dias[$fecha_actual->format('w')];
        $fecha = $dia . ', '.$fecha_actual->format('d') . ' de ' . $mes . ' de ' . $fecha_actual->format('Y');

        $pdf = PDF::loadView('compra/pdf_compra',compact('compras','total','fecha'));
        return $pdf->download('reporte_compras_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('compra/pdf_entrada',compact('entradas','total','fecha'));
    }
    public function reporte_ind($id){
        $cabecera = Compra_cabecera::find($id);
        $entradas = Compra_detalle::where('id_compra','=',$id)->get();
        $productos = Producto::where('isDeleted','=',0)->get();
        $proveedor = Proveedor::find($cabecera->id_proveedor);
        $usuario = User::find($cabecera->id_usuario);
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('compra/pdf_compra_ind',compact('cabecera','entradas','productos','proveedor','usuario','fecha'));
        return $pdf->download('compra_nro_'.$id.'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('salida/pdf_salida',compact('entradas','total','fecha'));
    }
    // Reporte en forma de recibo
    public function recibo_ind($id){
        $cabecera = Compra_cabecera::join('proveedors','compra_cabeceras.id_proveedor','=','proveedors.id')
        ->join('users','compra_cabeceras.id_usuario','=','users.id')
        ->select('compra_cabeceras.id','compra_cabeceras.numeracion','proveedors.nombre','proveedors.telefono','users.name','compra_cabeceras.created_at as fecha_emision','compra_cabeceras.monto_total')
        ->where('compra_cabeceras.id','=',$id)->first();
        $entradas = Compra_detalle::where('id_compra','=',$id)->get();
        $productos = Producto::where('isDeleted','=',0)->get();
        $fecha_actual = date_create(date('d-m-Y'));

        // Para conseguir fecha en español
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $fecha = Carbon::parse($cabecera->fecha_emision);
        $mes = $meses[($fecha->format('n')) - 1];
        $dia = $dias[$fecha->format('w')];
        $fecha_recibo = $dia . ', '.$fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');

        //tamaño personalizado de hoja de recibo
        $customPaper = array(0,0,567.00,450.00);

        //$pdf = PDF::loadView('compra/pdf_recibo',compact('cabecera','entradas','productos','fecha_recibo'))->setPaper($customPaper, 'landscape');
        $pdf = PDF::loadView('compra/pdf_recibo',compact('cabecera','entradas','productos','fecha_recibo'));
        return $pdf->download('recibo_nro_'.str_pad($cabecera->numeracion, 8, '0', STR_PAD_LEFT).'_'.date_format($fecha_actual,"Y-m-d").'.pdf');
    }
    public function guardar(Request $request){
        try {
            $total = 0;
            $fecha = '';
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
            //$filas_tabla = $request->tabla;

            foreach($filas_tabla as $fila){
                $total = $total + (($fila->precio_compra)*($fila->cantidad));
            }
            // Ultimo numero de recibo
            $last = Compra_cabecera::max('numeracion');
            //Proceso
            $cabecera = new Compra_cabecera();
            //$cabecera->nit_ci = $request->nit_ci;
            $cabecera->numeracion = $last + 1;
            $cabecera->id_proveedor = $request->id_proveedor;
            $cabecera->monto_total = $total;
            $cabecera->id_usuario = auth()->user()->id;

            // Si no se introdujo ninguna fecha, se establece la fecha actual
            if(empty($request->fecha_compra)){
                $fecha = date('Y-m-d', strtotime(Carbon::now()));
                $cabecera->hora_compra = date('H:i a', strtotime(Carbon::now()));
            }else{
                $fecha = $request->fecha_compra;

            }
            $cabecera->fecha_compra = $fecha;
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
            // return response()->json(['success'=>'Data is successfully added']);
            // return response()->json(['success'=>$filas_tabla]);
            return response()->json(['status'=>'success','message'=>'Compra registrada correctamente']);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error','message'=>$th]);
        }
    }
}
