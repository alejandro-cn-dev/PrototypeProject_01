<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Parametro;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;

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
        // $productos = Producto::join('marcas','productos.id_marca','=','marcas.id')
        // ->join('categorias','productos.id_categoria','=','categorias.id')
        // ->select('productos.id','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria')
        // ->where('productos.isDeleted','=',0)
        // ->get();
        $productos = DB::table('productos')
        ->leftjoin('venta_detalles', 'productos.id', '=', 'venta_detalles.id_producto')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->leftjoin('compra_detalles','productos.id', '=', 'compra_detalles.id_producto')
        ->select(
            'productos.id','productos.nombre','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria',
            //DB::raw('(COALESCE(SUM(compra_detalles.cantidad), 0) - COALESCE(SUM(venta_detalles.cantidad), 0)) AS existencia'),
            DB::raw('(COALESCE(SUM(CASE WHEN compra_detalles.isDeleted = 0 THEN compra_detalles.cantidad ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN venta_detalles.isDeleted = 0 THEN venta_detalles.cantidad ELSE 0 END), 0)) AS existencia'),
        )
        ->groupBy('productos.id','productos.nombre','productos.color','productos.precio_venta','productos.unidad','marcas.detalle','categorias.nombre')
        ->orderByDesc('existencia')
        ->where('compra_detalles.isDeleted','=',0)
        ->where('venta_detalles.isDeleted','=',0)
        ->where('productos.isDeleted','=',0)
        ->limit(5)
        ->get();
        $mensaje = Parametro::find(7);
        $imagenes = Imagen::where('tabla','=','productos')->get();
        return view('vitrina.index',['productos'=>$productos,'imagenes'=>$imagenes,'mensaje_bienvenida'=>$mensaje->valor]);
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
        $productos = DB::table('productos')
        ->select(
            'productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','productos.id_categoria','categorias.nombre as categoria',
            DB::raw('(COALESCE(SUM(CASE WHEN compra_detalles.isDeleted = 0 THEN compra_detalles.cantidad ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN venta_detalles.isDeleted = 0 THEN venta_detalles.cantidad ELSE 0 END), 0)) AS existencia'),
        )
        ->leftjoin('compra_detalles','productos.id', '=', 'compra_detalles.id_producto')
        ->leftjoin('venta_detalles', 'productos.id', '=', 'venta_detalles.id_producto')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->groupBy('productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marca','productos.id_categoria','categoria')
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
        // $producto = Producto::join('marcas','productos.id_marca','=','marcas.id')
        // ->join('categorias','productos.id_categoria','=','categorias.id')
        // ->select('productos.id','productos.id_categoria','productos.item_producto',DB::raw("((SELECT COALESCE(SUM(cantidad),0) FROM `compra_detalles` WHERE id_producto = productos.id AND isDeleted = 0) - (SELECT COALESCE(SUM(cantidad),0) FROM `venta_detalles` WHERE id_producto = productos.id AND isDeleted = 0)) AS existencia"),'productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria')
        // ->where('productos.isDeleted','=',0)
        // ->where('productos.id','=',$id)
        // ->first();
        $producto_detalle = DB::table('productos')
        ->select(
            'productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','productos.material','productos.calidad','marcas.detalle as marca','productos.id_categoria','categorias.nombre as categoria',
            DB::raw('(COALESCE(SUM(CASE WHEN compra_detalles.isDeleted = 0 THEN compra_detalles.cantidad ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN venta_detalles.isDeleted = 0 THEN venta_detalles.cantidad ELSE 0 END), 0)) AS existencia'),
            //DB::raw('(COALESCE(SUM(compra_detalles.cantidad), 0) - COALESCE(SUM(venta_detalles.cantidad), 0)) AS existencia'),
        )
        ->leftjoin('compra_detalles','productos.id', '=', 'compra_detalles.id_producto')
        ->leftjoin('venta_detalles', 'productos.id', '=', 'venta_detalles.id_producto')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->groupBy('productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','productos.material','productos.calidad','marca','productos.id_categoria','categoria')
        ->where('productos.isDeleted','=',0)
        ->where('productos.id','=',$id)
        ->first();
        // Recuperar registros de productos que son de la misma categoria por 'id_categoria'
        // $relacionados = Producto::join('marcas','productos.id_marca','=','marcas.id')
        // ->join('categorias','productos.id_categoria','=','categorias.id')
        // ->select('productos.id','productos.nombre','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','categorias.nombre as categoria')
        // ->where('productos.isDeleted','=',0)
        // ->where('productos.id_categoria','=',$producto->id_categoria)
        // ->where('productos.id','!=',$id)
        // ->get();
        $relacionados = DB::table('productos')
        ->select(
            'productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','productos.id_categoria','categorias.nombre as categoria',
            //DB::raw('(COALESCE(SUM(CASE WHEN compra_detalles.isDeleted = 0 THEN compra_detalles.cantidad ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN venta_detalles.isDeleted = 0 THEN venta_detalles.cantidad ELSE 0 END), 0)) AS existencia'),
            DB::raw('(COALESCE(SUM(compra_detalles.cantidad), 0) - COALESCE(SUM(venta_detalles.cantidad), 0)) AS existencia'),
        )
        ->leftjoin('compra_detalles','productos.id', '=', 'compra_detalles.id_producto')
        ->leftjoin('venta_detalles', 'productos.id', '=', 'venta_detalles.id_producto')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->groupBy('productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.id_categoria','productos.unidad','marcas.detalle','categorias.nombre')
        ->orderByDesc('existencia')
        ->where('productos.isDeleted','=',0)
        ->where('productos.id_categoria','=',$producto_detalle->id_categoria)
        ->where('productos.id','!=',$id)
        ->limit(4)
        ->get();
        $imagenes = Imagen::where('tabla','=','productos')->where('id_registro','=',$id)->first();
        $imagenes_rel = Imagen::where('tabla','=','productos')->get();
        return view('vitrina.product', ['producto' => $producto_detalle, 'relacionados' => $relacionados, 'imagenes' => $imagenes, 'imagenes_rel' => $imagenes_rel]);
    }

    // Buscar productos
    public function buscar(Request $request){
        $product =$request->get('product');
        $result = DB::table('productos')
        ->select(
            'productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marcas.detalle as marca','productos.id_categoria','categorias.nombre as categoria',
            DB::raw('(COALESCE(SUM(CASE WHEN compra_detalles.isDeleted = 0 THEN compra_detalles.cantidad ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN venta_detalles.isDeleted = 0 THEN venta_detalles.cantidad ELSE 0 END), 0)) AS existencia'),
            //DB::raw('(COALESCE(SUM(compra_detalles.cantidad), 0) - COALESCE(SUM(venta_detalles.cantidad), 0)) AS existencia'),
        )
        ->leftjoin('compra_detalles','productos.id', '=', 'compra_detalles.id_producto')
        ->leftjoin('venta_detalles', 'productos.id', '=', 'venta_detalles.id_producto')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->groupBy('productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.precio_venta','productos.unidad','marca','productos.id_categoria','categoria')
        ->where('productos.isDeleted','=',0)
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
