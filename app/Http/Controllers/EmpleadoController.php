<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rol;
use Spatie\Permission\Traits\HasRoles;
use PDF;

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
        $usuarios = User::where('isDeleted','=',0)->get();
        return view('empleado.index')->with('empleados',$usuarios);
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
        $id_rol = $request->get('id_rol');
        $roles = Rol::where('id','=',$id_rol)->first();
        
        $usuario = new User();
        $usuario->email = $email = $request->get('email');
        $usuario->name = $nombre = $request->get('nombre');
        $usuario->password = $request->get('password');
        $usuario->role = $roles->detalle;
        $usuario->save();

        $empleados = new User();        
        $empleados->ap_paterno = $ap_paterno =$request->get('ap_paterno');
        $empleados->ap_materno = $ap_materno = $request->get('ap_materno');
        $empleados->nombre = $nombre;
        $empleados->ci = $ci = $request->get('ci');
        $empleados->expedido = $exp = $request->get('expedido');
        $empleados->telefono = $request->get('telefono');
        //$empleados->matricula = $request->get('matricula');
        $empleados->id_user = $usuario->id;
        $empleados->matricula = strtoupper(substr($ap_paterno,0,1)).strtoupper(substr($ap_materno,0,1)).strtoupper(substr($nombre,0,1)).$ci.$exp;
        $empleados->id_rol = $id_rol;
        //$empleados->email = $email;
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
        $empleado = User::find($id);
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
        $id_rol = $request->get('id_rol');
        $id_user = $request->get('id_user');
        $roles = Rol::where('id','=',$id_rol)->first();

        $email = $request->get('email');
        $nombre = $request->get('nombre');
        $pass = $request->get('password');
        $usuario = User::find($id_user);
        $usuario->name = $nombre;
        $usuario->save();

        $empleado = User::find($id);
        $empleado->ap_paterno = $ap_paterno = $request->get('ap_paterno');
        $empleado->ap_materno = $ap_materno = $request->get('ap_materno');
        $empleado->nombre = $nombre;
        $empleado->ci = $ci = $request->get('ci');
        $empleado->expedido = $exp = $request->get('expedido');
        $empleado->telefono = $request->get('telefono');
        $empleado->id_user = $usuario->id;
        //$empleado->matricula = $request->get('matricula');
        $empleado->matricula = strtoupper(substr($ap_paterno,0,1)).strtoupper(substr($ap_materno,0,1)).strtoupper(substr($nombre,0,1)).$ci.$exp;
        $empleado->id_rol = $request->get('id_rol');
        //$empleado->email = $email;
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
        $empleado = User::find($id);
        $empleado->isDeleted = true;
        $empleado->save();
        //$empleado->delete();
        return redirect('/empleados');
    }

    //Funciones propias
    public function reporte(){
        $empleados = User::where('empleados.isDeleted','=',0)->get();
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('empleado/pdf_empleado',compact('empleados','fecha'));
        return $pdf->download('empleados_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('empleado/pdf_empleado',compact('empleados','fecha'));
    }
}
