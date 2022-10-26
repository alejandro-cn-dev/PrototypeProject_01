<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

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
        $empleados = Empleado::all();
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
        $empleados->ap_paterno = $request->get('ap_paterno');
        $empleados->ap_materno = $request->get('ap_materno');
        $empleados->nombre = $request->get('nombre');
        $empleados->telefono = $request->get('telefono');
        $empleados->matricula = $request->get('matricula');
        $empleados->id_rol = $request->get('id_rol');
        $empleados->id_user = $request->get('id_user');
        $empleados->estado = $request->get('estado');       

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
        $empleado->ap_paterno = $request->get('ap_paterno');
        $empleado->ap_materno = $request->get('ap_materno');
        $empleado->nombre = $request->get('nombre');
        $empleado->telefono = $request->get('telefono');
        $empleado->matricula = $request->get('matricula');
        $empleado->id_rol = $request->get('id_rol');
        $empleado->id_user = $request->get('id_user');
        $empleado->estado = $request->get('estado');   

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
        $empleado->delete();
        return redirect('/empleados');
    }
}
