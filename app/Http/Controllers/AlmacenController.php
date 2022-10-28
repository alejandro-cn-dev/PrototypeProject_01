<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;

class AlmacenController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //$almacenes = Almacen::all();
        $almacenes = Almacenes::where('isEnable','=',1)->get();
        return view('almacen.index')->with('almacenes',$almacenes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $almacenes = new Almacen();
        $nombre = $request->get('nombre');
        $almacenes->nombre = $nombre;
        $almacenes->tipo = $request->get('tipo');
        $almacenes->matricula = auth()->user()->matricula;
        $almacenes->sufijo_almacen = strtoupper(substr($nombre,0,2));
        $almacenes->save();

        return redirect('/almacens');
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
        $almacen = Almacen::find($id);
        return view('almacen.edit')->with('almacen',$almacen);
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
        $almacen = Almacen::find($id);
        $nombre = $request->get('nombre');
        $almacen->nombre = $nombre;
        $almacen->tipo = $request->get('tipo');
        $almacen->sufijo_almacen = strtoupper(substr($nombre,0,2));

        $almacen->save();

        return redirect('/almacens');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $almacen = Almacen::find($id);        
        $almacen->isEnable = false;
        $almacen->save();
        //$almacen->delete();
        return redirect('/almacens');
    }
}
