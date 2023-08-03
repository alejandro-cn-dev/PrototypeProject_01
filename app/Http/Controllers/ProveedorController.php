<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provedores = Proveedor::where('isDeleted','=',0)->get();
        return view('proveedor.index')->with('proveedors',$provedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provedor = new Proveedor();
        $provedor->nombre = $request->get('nombre');
        $provedor->telefono = $request->get('telefono');
        $provedor->id_usuario = auth()->user()->id;
        $provedor->save();

        return redirect('/proveedor');
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
        $provedor = Proveedor::find($id);
        return view('proveedor.edit');
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
        $provedor = Proveedor::find($id);
        $provedor->nombre = $request->get('nombre');
        $provedor->telefono = $request->get('telefono');
        $provedor->id_usuario = auth()->user()->id;
        $provedor->save();

        return redirect('/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provedor = Proveedor::find($id);
        $provedor->isDeleted = true;
        $provedor->save();

        return redirect('/proveedor');
    }
}
