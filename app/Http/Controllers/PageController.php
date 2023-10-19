<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Parametro;
use Carbon\Carbon;
use DB;
use PDF;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Vista principal de la homepage
    public function index()
    {
        $productos = Producto::join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->select('productos.id','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.isDeleted','=',0)
        ->get();
        $imagenes = Imagen::where('tabla','=','productos')->get();
        return view('vitrina.index')->with('productos',$productos)->with('imagenes',$imagenes);
        //return view('vitrina.index', ['productos' => $productos]);
    }

    // Vista de la mision y vision
    public function info(){
        $info = Parametro::select('nombre','valor')->whereIn('nombre',['mision','vision','descripción_empresa'])->get();
        return view('vitrina.info')->with('info',$info);
    }

    // Listado de todos los productos
    // Deberia poder filtrar con un buscador aqui
    public function lista()
    {
        $productos = Producto::join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        // ->select('productos.id','productos.descripcion','productos.color','productos.existencia','productos.precio_venta','productos.unidad_venta','marcas.detalle as marca','categorias.nombre as categoria')
        ->select('productos.id','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.isDeleted','=',0)
        ->get();
        $imagenes = Imagen::where('tabla','=','productos')->get();
        return view('vitrina.lista', ['productos' => $productos, 'imagenes' => $imagenes]);
    }

    // Listado de productos por categorias
    public function porcat()
    {
        
    }

    // Vista de producto individual
    public function producto($id)
    {
        // Recuperar registro de producto mediante 'id'
        //$producto = Producto::find($id);
        $producto = Producto::join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->select('productos.id','productos.id_categoria','productos.item_producto',DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM `compra_detalles` WHERE id_producto = productos.id AND isDeleted = 0) - (SELECT COALESCE(SUM(cantidad),0) FROM `venta_detalles` WHERE id_producto = productos.id AND isDeleted = 0)) AS existencia"),'productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.isDeleted','=',0)
        ->where('productos.id','=',$id)
        ->first();        
        // Recuperar registros de productos que son de la misma categoria por 'id_categoria'
        $relacionados = Producto::join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->select('productos.id','productos.nombre','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.isDeleted','=',0)
        ->where('productos.id_categoria','=',$producto->id_categoria)
        ->where('productos.id','!=',$id)
        ->get();
        $imagenes = Imagen::where('tabla','=','productos')->where('id_registro','=',$id)->first();
        $imagenes_rel = Imagen::where('tabla','=','productos')->get();
        return view('vitrina.product', ['producto' => $producto, 'relacionados' => $relacionados, 'imagenes' => $imagenes, 'imagenes_rel' => $imagenes_rel]);
    }
    
    // Buscar productos
    public function buscar(Request $request){
        $product =$request->get('product');
        $result = Producto::join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->select('productos.id','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.nombre','LIKE','%'.$product.'%')
        ->orWhere('productos.item_producto','LIKE','%'.$product.'%')->get();
        $imagenes = Imagen::where('tabla','=','productos')->get();
        if(count($result) > 0)
            //return view('vitrina.product')->withDetails($result)->withQuery ( $product );
            return view('vitrina.lista')->with('productos',$result)->with('term',$product)->with('imagenes',$imagenes);
        else return view ('vitrina.lista')->with('productos',null);
    }
    //Para probar los nuevos reportes (borrar luego)
    public function reporte_test()
    {
        // Para conseguir fecha en español
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
        $fecha = Carbon::now();
        $mes = $meses[($fecha->format('n')) - 1];
        $dia = $dias[$fecha->format('w')];
        $fecha_actual = $dia . ', '.$fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        //$fecha_actual = date_create(date('d-m-Y'));
        //$fecha = date_format($fecha_actual,'d-m-Y');
        $hora_actual = $fecha->format('H:i:s');
        $pdf = PDF::loadView('reporte/test3',compact('fecha_actual','hora_actual'));
        return $pdf->download('test_000000_'.date_format($fecha,"Y-m-d").'.pdf');
    }
}
