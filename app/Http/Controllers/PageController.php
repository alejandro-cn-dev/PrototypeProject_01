<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

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
        ->select('productos.id','productos.descripcion','productos.color','productos.existencia','productos.precio_venta','productos.unidad_venta','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.isDeleted','=',0)
        ->get();
        return view('vitrina.index')->with('productos',$productos);
        //return view('vitrina.index', ['productos' => $productos]);
    }

    // Vista de la mision y vision
    public function info(){
        return view('vitrina.info');
    }

    // Listado de todos los productos
    // Deberia poder filtrar con un buscador aqui
    public function lista()
    {
        $productos = Producto::join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->select('productos.id','productos.descripcion','productos.color','productos.existencia','productos.precio_venta','productos.unidad_venta','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.isDeleted','=',0)
        ->get();
        return view('vitrina.lista', ['productos' => $productos]);
    }

    // Listado de productos por categorias
    public function porcat()
    {

    }

    // Vista de producto individual
    public function producto($id)
    {
        $producto = Producto::find($id);
        $relacionados = Categoria::where('id','=',$producto->id_categoria)->get();
        return view('vitrina.product', ['producto' => $producto, 'ralacionados' => $relacionados]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
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
}
