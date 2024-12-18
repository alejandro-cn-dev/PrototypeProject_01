<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;
use App\Models\Empleado;
use Barryvdh\DomPDF\Facade\PDF;

class AlmacenController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:almacens.index')->only('index');
        $this->middleware('can:almacens.create')->only('create','store');
        $this->middleware('can:almacens.edit')->only('edit','update');
        $this->middleware('can:almacens.delete')->only('destroy');
    }

    public function index()
    {
        //$almacenes = Almacen::all();
        $almacenes = Almacen::where('isDeleted','=',0)->get();
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
        try {
            $almacenes = new Almacen();
            $nombre = $request->get('nombre');
            $almacenes->nombre = $nombre;
            $almacenes->tipo = $request->get('tipo');
            $almacenes->id_usuario = auth()->user()->id;
            $almacenes->sufijo_almacen = strtoupper(substr($nombre,0,2));
            $almacenes->save();

            return redirect('/almacenes')->with('status','success')->with('message','Almacén agregado correctamente');
        } catch (\Throwable $th) {
            return redirect('/almacenes')->with('status','error')->with('message',$th);
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
        try {
            $almacen = Almacen::find($id);
            $nombre = $request->get('nombre');
            $almacen->nombre = $nombre;
            $almacen->tipo = $request->get('tipo');
            $almacen->sufijo_almacen = strtoupper(substr($nombre,0,2));

            $almacen->save();

            return redirect('/almacenes')->with('status','success')->with('message','Almacén actualizado correctamente');
        } catch (\Throwable $th) {
            return redirect('/almacenes')->with('status','error')->with('message',$th);
        }

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
        $almacen->isDeleted = true;
        $almacen->save();
        //$almacen->delete();
        $response = array(
            'status' => 'success',
            'msg' => 'listo',
        );
        return response()->json($response);
        //return redirect('/almacenes');
    }

    //Funciones propias
    public function reporte(){
        $almacens = Almacen::where('isDeleted','=',0)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('almacen/pdf_almacen',compact('almacens','fecha'));
        return $pdf->download('almacenes_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('almacen/pdf_almacen',compact('almacens','fecha'));
    }
}
