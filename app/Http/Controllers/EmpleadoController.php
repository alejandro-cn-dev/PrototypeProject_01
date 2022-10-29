<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\User;
use App\Models\Rol;

class EmpleadoController extends Controller
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
        //$empleados = Empleado::all();
        //recuperar el detalle de rol
        $empleados = Empleado::where('isEnable','=',1)->get();
        return view('empleado.index')->with('empleados',$empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleados = new Empleado();
        $empleados->ap_paterno = $ap_paterno =$request->get('ap_paterno');
        $empleados->ap_materno = $ap_materno = $request->get('ap_materno');
        $empleados->nombre = $nombre = $request->get('nombre');
        $empleados->ci = $ci = $request->get('ci');
        $empleados->expedido = $exp = $request->get('expedido');
        $empleados->telefono = $request->get('telefono');
        //$empleados->matricula = $request->get('matricula');
        $empleados->matricula = strtoupper(substr($ap_paterno,0,1)) + strtoupper(substr($ap_materno,0,1)) + strtoupper(substr($nombre,0,1)) + $ci + $exp;
        $empleados->id_rol = $request->get('id_rol');
        $empleados->email = $request->get('email');

        $empleados->save();
        return redirect('/empleados');
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
        $empleado = Empleado::find($id);
        return view('empleado.edit')->with('empleado',$empleado);
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
        $empleado = Empleado::find($id);
        $empleado->ap_paterno = $ap_paterno = $request->get('ap_paterno');
        $empleado->ap_materno = $ap_materno = $request->get('ap_materno');
        $empleado->nombre = $nombre = $request->get('nombre');
        $empleado->ci = $ci = $request->get('ci');
        $empleado->expedido = $exp = $request->get('expedido');
        $empleado->telefono = $request->get('telefono');
        //$empleado->matricula = $request->get('matricula');
        $empleados->matricula = strtoupper(substr($ap_paterno,0,1)) + strtoupper(substr($ap_materno,0,1)) + strtoupper(substr($nombre,0,1)) + $ci + $exp;
        $empleado->id_rol = $request->get('id_rol');

        $empleado->save();
        return redirect('/empleados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->isEnable = false;
        $empleado->save();
        //$empleado->delete();
        return redirect('/empleados');
    }
}
