<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Almacen;
use App\Models\Marca;

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
        ->join('almacens','productos.id_almacen','=','almacens.id')
        ->join('marcas','productos.id_marca','=','marcas.id')
        ->select('productos.id','productos.item_producto','productos.descripcion','productos.color',
        'categorias.nombre as id_categoria',
        'almacens.nombre as id_almacen','marcas.detalle as id_marca','productos.estado')->get();

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
        $productos = new Producto();
        $productos->item_producto = $request->get('item_producto');
        $productos->descripcion = $request->get('descripcion');
        $productos->color = $request->get('color');
        $productos->id_categoria = $request->get('id_categoria');
        $productos->id_almacen = $request->get('id_almacen');
        $productos->id_marca = $request->get('id_marca');
        $productos->id_empleado = $request->get('id_empleado');
        $productos->estado = $request->get('estado');

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
        $producto = Producto::find($id);
        return view('producto.edit')->with('producto',$producto);
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
        $producto->item_producto = $request->get('item_producto');
        $producto->descripcion = $request->get('descripcion');
        $producto->color = $request->get('color');
        $producto->id_categoria = $request->get('id_categoria');
        $producto->id_almacen = $request->get('id_almacen');
        $producto->id_marca = $request->get('id_marca');
        $producto->estado = $request->get('estado');

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
        $producto->delete();
        return redirect('/productos');
    }
}
