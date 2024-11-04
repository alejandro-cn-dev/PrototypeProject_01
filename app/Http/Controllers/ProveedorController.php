<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Marca;
use Barryvdh\DomPDF\Facade\PDF;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:proveedores.index')->only('index');
        $this->middleware('can:proveedores.create')->only('create','store');
        $this->middleware('can:proveedores.edit')->only('edit','update');
        $this->middleware('can:proveedores.delete')->only('destroy');
    }

    public function index()
    {
        $provedores = Proveedor::join('marcas','proveedors.id_marca','=','marcas.id')
        ->select('proveedors.id','proveedors.nombre','proveedors.telefono','marcas.detalle AS marca')
        ->where('proveedors.isDeleted','=',0)->get();
        return view('proveedor.index')->with('proveedors',$provedores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = Marca::where('isDeleted','=',0)->get();
        return view('proveedor.create')->with('marcas',$marcas);
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
            $provedor = new Proveedor();
            $provedor->nombre = $request->get('nombre');
            $provedor->telefono = $request->get('telefono');
            $provedor->id_marca = $request->get('marca');
            $provedor->id_usuario = auth()->user()->id;
            $provedor->save();

            return redirect('/proveedores')->with('status','success')->with('message','Proveedor agregado correctamente');
        } catch (\Throwable $th) {
            return redirect('/proveedores')->with('status','error')->with('message',$th);
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
        $provedor = Proveedor::find($id);
        $marcas = Marca::where('isDeleted','=',0)->get();
        return view('proveedor.edit')->with('proveedor',$provedor)->with('marcas',$marcas);
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
            $provedor = Proveedor::find($id);
            $provedor->nombre = $request->get('nombre');
            $provedor->telefono = $request->get('telefono');
            $provedor->id_marca = $request->get('marca');
            $provedor->id_usuario = auth()->user()->id;
            $provedor->save();

            return redirect('/proveedores')->with('status','success')->with('message','Proveedor actualizado correctamente');
        } catch (\Throwable $th) {
            return redirect('/proveedores')->with('status','error')->with('message',$th);
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
        $provedor = Proveedor::find($id);
        $provedor->isDeleted = true;
        $provedor->save();

        $response = array(
            'status' => 'success',
            'msg' => 'listo',
        );
        return response()->json($response);
        //return redirect('/proveedores');
    }

    public function reporte(){
        $proveedores = Proveedor::select('proveedors.nombre','proveedors.telefono','marcas.detalle AS marca')
        ->join('marcas','proveedors.id_marca','=','marcas.id')->where('proveedors.isDeleted','=',0)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('proveedor/pdf_proveedor',compact('proveedores','fecha'));
        return $pdf->download('proveedores'.date_format($fecha_actual,"Y-m-d").'.pdf');
    }
}
