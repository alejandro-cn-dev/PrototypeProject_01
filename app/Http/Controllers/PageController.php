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
        // Recuperar registro de producto mediante 'id'
        //$producto = Producto::find($id);
        $producto = Producto::join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->select('productos.id','productos.id_categoria','productos.descripcion','productos.color','productos.existencia','productos.precio_venta','productos.unidad_venta','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.isDeleted','=',0)
        ->where('productos.id','=',$id)
        ->first();        
        // Recuperar registros de productos que son de la misma categoria por 'id_categoria'
        $relacionados = Producto::join('marcas','productos.id_marca','=','marcas.id')
        ->join('categorias','productos.id_categoria','=','categorias.id')
        ->select('productos.id','productos.descripcion','productos.color','productos.existencia','productos.precio_venta','productos.unidad_venta','marcas.detalle as marca','categorias.nombre as categoria')
        ->where('productos.isDeleted','=',0)
        ->where('productos.id_categoria','=',$producto->id_categoria)
        ->where('productos.id','!=',$id)
        ->get();
        return view('vitrina.product', ['producto' => $producto, 'relacionados' => $relacionados]);
    }
    
    // Buscar productos
    public function buscar(Request $request){
        $product =$request->get('product');
        $result = Producto::where('descripcion','LIKE','%'.$product.'%')->orWhere('item_producto','LIKE','%'.$product.'%')->get();
        if(count($result) > 0)
            //return view('vitrina.product')->withDetails($result)->withQuery ( $product );
            return view('vitrina.lista')->with('productos',$result)->with('term',$product);
        else return view ('vitrina.lista')->with('productos',null);
        }
}
