<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Almacen;
use App\Models\Marca;
use App\Models\Empleado;
use App\Models\Imagen;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:productos.index')->only('index');
        $this->middleware('can:productos.create')->only('create','store');
        $this->middleware('can:productos.edit')->only('edit','update');
        $this->middleware('can:productos.delete')->only('destroy');
    }

    public function index()
    {
        //$productos = Producto::all();
        $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.nombre','productos.descripcion','productos.color','productos.medida','productos.calidad','productos.unidad',
        'categorias.nombre as id_categoria',
        'almacens.nombre as id_almacen',
        'marcas.detalle as id_marca')
        ->where('productos.isDeleted','=',0)->get();
        $imagenes = Imagen::where('tabla','=','productos')->get();

        return view('producto.index')->with('productos',$productos)->with('imagenes',$imagenes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::select('id','nombre')->where('isDeleted','=',0)->get();
        $marcas = Marca::select('id','detalle')->where('isDeleted','=',0)->get();
        $almacenes = Almacen::select('id','nombre')->where('isDeleted','=',0)->get();
        return view('producto.create')
        ->with('categorias',$categorias)
        ->with('marcas',$marcas)
        ->with('almacenes',$almacenes);
        //return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $productos = new Producto();
            $productos->nombre = $request->get('nombre');
            $productos->descripcion = $request->get('descripcion');
            $color = $request->get('color');
            if(empty($color)){
                $color = 'Sin color';
            }
            $productos->color = $color;
            if(!empty($request->get('calidad'))){
                $productos->calidad = $request->get('calidad');
            }
            if(!empty($request->get('medida'))){
                $productos->medida = $request->get('medida');
            }

            $productos->id_almacen = $request->get('id_almacen');

            $productos->precio_compra = $request->get('precio_compra');
            $productos->precio_venta = $request->get('precio_venta');
            $productos->unidad = $request->get('unidad');

            $productos->id_categoria = $id_categoria = $request->get('id_categoria');
            $categoria = Categoria::where('id','=',$id_categoria)->first();
            $productos->id_marca = $id_marca = $request->get('id_marca');
            // $marca = Marca::where('id','=',$id_marca)->first();
            $productos->id_usuario = auth()->user()->id;
            //$prefijo_matricula = strtoupper(substr($categoria->nombre,0,2)).'-'.strtoupper(substr($marca->detalle,0,2));
            //$last_id = Producto::where('item_producto','LIKE',$prefijo_matricula.'%')->sortByDesc()->get();
            //$last_id = Producto::orderBy('id','DESC')->where('item_producto','LIKE',$prefijo_matricula.'%')->where('isDeleted','=',1)->first();
            //$grupo_productos = Producto::where('item_producto','LIKE',$prefijo_matricula.'%')->get();
            $num_item = Producto::where('id_categoria','=',$categoria->id)->where('isDeleted','=',0)->get();
            $productos->item_producto = $categoria->sufijo_categoria.'-'.str_pad(($num_item->count() + 1), 3, '0', STR_PAD_LEFT);
            $productos->save();

            // verificar si existe una imagen
            if(!empty($request->file('imagen'))){
                // subir imagen
                $imagen = $request->file('imagen');
                //obtenemos el nombre del archivo
                $nombre =  time()."_"."producto_".$productos->id.".".$imagen->extension();
                //indicamos que queremos guardar un nuevo archivo en el disco local
                Storage::disk('images')->put($nombre,  File::get($imagen));

                // guardar referencias a imagen
                $datos_imagen = new Imagen();
                $datos_imagen->tabla = "productos";
                $datos_imagen->id_registro = $productos->id;
                $datos_imagen->nombre_imagen = $nombre;
                $datos_imagen->ubicacion = storage_path('images');
                $datos_imagen->save();
            }

            return redirect('/productos')->with('status','success')->with('message','Producto agregado correctamente');
            //return back()->with('status','success')->with('message','Producto agregado correctamente');
        } catch (\Throwable $th) {
            return back()->with('status','error')->with('message',$th);
        }

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
        $categorias = Categoria::select('id','nombre')->get();
        $marcas = Marca::select('id','detalle')->get();
        $almacenes = Almacen::select('id','nombre')->get();
        $producto = Producto::find($id);
        return view('producto.edit')
        ->with('categorias',$categorias)
        ->with('marcas',$marcas)
        ->with('almacenes',$almacenes)
        ->with('producto',$producto);
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
        $producto = Producto::find($id);
        $producto->descripcion = $request->get('descripcion');
        $producto->color = $request->get('color');
        //$producto->id_categoria = $request->get('id_categoria');
        $producto->id_almacen = $request->get('id_almacen');
        //$producto->id_marca = $request->get('id_marca');
        $producto->precio_compra = $request->get('precio_compra');
        $producto->precio_venta = $request->get('precio_venta');
        $producto->unidad = $request->get('unidad');
        if(!empty($request->get('calidad'))){
            $producto->calidad = $request->get('calidad');
        }else{
            $producto->calidad = 'Estandar';
        }
        if(!empty($request->get('medida'))){
            $producto->medida = $request->get('medida');
        }else{
            $producto->medida = '[N/A]';
        }

        $producto->save();

        return redirect('/productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->isDeleted = true;
        $producto->save();
        //$producto->delete();
        $response = array(
            'status' => 'success',
            'msg' => 'listo',
        );
        return response()->json($response);
        //return redirect('/productos');
    }

    //Funciones propias
    public function reporte(){
        $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.descripcion','productos.color', 'productos.nombre',
        'categorias.nombre as id_categoria',
        'almacens.nombre as id_almacen',
        'marcas.detalle as id_marca')
        ->where('productos.isDeleted','=',0)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('producto/pdf_producto',compact('productos','fecha'));
        return $pdf->download('productos_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('producto/pdf_producto',compact('productos','fecha'));
    }
}
