<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        $this->middleware('can:empleados.index')->only('index');
        $this->middleware('can:empleados.create')->only('create','store');
        $this->middleware('can:empleados.edit')->only('edit','update');
        $this->middleware('can:empleados.delete')->only('destroy');
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
        $roles =  Role::all();
        return view('empleado.create')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User();
        $usuario->ap_paterno = $ap_paterno = $request->get('ap_paterno');
        $usuario->ap_materno = $ap_materno = $request->get('ap_materno');
        $usuario->name = $nombre = $request->get('nombre');
        $usuario->ci = $ci = $request->get('ci');
        $usuario->expedido = $exp = $request->get('expedido');
        $usuario->telefono = $request->get('telefono');
        $usuario->matricula = strtoupper(substr($ap_paterno,0,1)).strtoupper(substr($ap_materno,0,1)).strtoupper(substr($nombre,0,1)).$ci.$exp;
        $usuario->email = $request->get('email');
        $usuario->password = $request->get('password');
        $usuario->save();
        $usuario->assignRole($request->get('role'));

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
        $roles = Role::all();
        return view('empleado.edit')->with('empleado',$empleado)->with('roles',$roles);
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
        //$id_rol = $request->get('id_rol');
        //$id_user = $request->get('id_user');
        //$roles = Rol::where('id','=',$id_rol)->first();
        
        // $usuario = User::find($id_user);
        // $usuario->name = $nombre;
        // $usuario->save();
        $usuario = User::find($id);
        $usuario->ap_paterno = $ap_paterno = $request->get('ap_paterno');
        $usuario->ap_materno = $ap_materno = $request->get('ap_materno');
        $usuario->name = $nombre = $request->get('nombre');
        $usuario->ci = $ci = $request->get('ci');
        $usuario->expedido = $exp = $request->get('expedido');
        $usuario->telefono = $request->get('telefono');
        $usuario->matricula = strtoupper(substr($ap_paterno,0,1)).strtoupper(substr($ap_materno,0,1)).strtoupper(substr($nombre,0,1)).$ci.$exp;
        // $usuario->email = $request->get('email');
        // $usuario->password = $request->get('password');
        $usuario->save();
        $usuario->assignRole($request->get('role'));

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
        $response = array(
            'status' => 'success',
            'msg' => 'listo',
        );
        return response()->json($response);
        //return redirect('/empleados');
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
    public function form_cambio_contraseña($id){
        $usuario = User::find($id);
        return view('empleado.cambio_contraseña')->with('empleado',$usuario);
    }
}
