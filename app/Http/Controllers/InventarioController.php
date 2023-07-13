<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra_detalle;
use App\Models\Venta_detalle;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta_detalle::join('productos','venta_detalles.id_producto','=','productos.id')
        ->select('id_venta AS id_cabecera','precio_unitario AS costo','cantidad','id_producto','venta_detalles.created_at','productos.descripcion','productos.item_producto')
        ->where('venta_detalles.isDeleted','=',0);
        $inventario = Compra_detalle::join('productos','compra_detalles.id_producto','=','productos.id')
        ->select('id_compra AS id_cabecera','costo_compra AS costo','cantidad','id_producto','compra_detalles.created_at','productos.descripcion','productos.item_producto')
        ->where('compra_detalles.isDeleted','=',0)
        ->union($ventas)->get();
        return view('inventario.index')->with('inventarios',$inventario);
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
