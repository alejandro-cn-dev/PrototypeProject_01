<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Almacen;
use App\Models\Marca;
use App\Models\Empleado;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //$productos = Producto::all();
        $productos = Producto::join('categorias','productos.id_categoria','=','categorias.id')
        //->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.descripcion','productos.color',
        'categorias.nombre as id_categoria',
        //'almacens.nombre as id_almacen',
        'marcas.detalle as id_marca')
        ->where('producto.isEnable','=',1)->get();

        return view('producto.index')->with('productos',$productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::select('id','nombre')->get();
        $marcas = Marca::select('id','detalle')->get();
        $almacenes = Almacen::select('id','nombre')->get();
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
        $id_user = auth()->user()->id;
        $empleado = Empleado::where('id_user','=',$id_user)->first();

        $productos = new Producto();                        
        $productos->descripcion = $request->get('descripcion');
        $productos->color = $request->get('color');
        $productos->id_almacen = $request->get('id_almacen');
        $productos->id_categoria = $id_categoria = $request->get('id_categoria');
        $categoria = Categoria::where('id','=',$id_categoria);
        $productos->id_marca = $id_marca = $request->get('id_marca');
        $marca = Marca::where('id_marca'.'=',$id_marca);
        $productos->matricula = $empleado->matricula;
        $prefijo_matricula = strtoupper(substr($marca->detalle,0,2)).'-'.strtoupper(substr($categoria->nombre,0,2));
        $last_id = Producto::where('item_producto','LIKE',$prefijo_matricula.'%')->sortDesc()->first();
        $str_num = '001';
        if(count($last_id) > 0){
            $matricula_anterior = strtoupper(substr($last_id->matricula,7,9)) ;
            $num_item = (int)$matricula_anterior;
            $num_item = $num_item + 1;
            
            if(strlen($num_item)<10){
                $str_num = '00'.$num_item;
            }
            if(strlen($num_item)<100){
                $str_num = '0'.$num_item;
            }
        }
        
        $productos->item_producto = $prefijo_matricula.$str_num;

        $productos->save();

        return redirect('/productos');
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
        $producto->id_categoria = $request->get('id_categoria');
        $producto->id_almacen = $request->get('id_almacen');
        $producto->id_marca = $request->get('id_marca');

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
        $producto->isEnable = false;
        $producto->save();
        //$producto->delete();
        return redirect('/productos');
    }
}