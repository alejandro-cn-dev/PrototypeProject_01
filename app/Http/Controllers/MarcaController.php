<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Empleado;
use PDF;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:marcas.index')->only('index');
        $this->middleware('can:marcas.create')->only('create','store');
        $this->middleware('can:marcas.edit')->only('edit','update');
        $this->middleware('can:marcas.delete')->only('destroy');
    }

    public function index()
    {
        //$marcas = Marca::all();
        $marcas = Marca::where('isDeleted','=',0)->get();
        return view('marca.index')->with('marcas',$marcas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marcas = new Marca();
        $detalle = $request->get('detalle');
        $marcas->detalle = $detalle;       
        $marcas->id_usuario = auth()->user()->id;
        $marcas->sufijo_marca = strtoupper(substr($detalle,0,2));

        $marcas->save();

        return redirect('/marcas');
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
        $marca = Marca::find($id);     
        return view('marca.edit')->with('marca',$marca);
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
        $marcas = Marca::find($id);
        $detalle = $request->get('detalle');
        $marcas->detalle = $detalle;
        $marcas->sufijo_marca = strtoupper(substr($detalle,0,2));
        $marcas->save();

        return redirect('/marcas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = Marca::find($id);
        //$marca->delete();
        $marca->isDeleted = true;
        $marca->save();
        return redirect('/marcas');
    }
    //Funciones propias
    public function reporte(){
        $marcas = Marca::where('isDeleted','=',0)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('marca/pdf_marca',compact('marcas','fecha'));
        return $pdf->download('marcas_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('marca/pdf_marca',compact('marcas','fecha'));
    }
}
