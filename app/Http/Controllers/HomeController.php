<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta_cabecera;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Rol;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ventas = Venta_cabecera::where('isEnable','=',1)->count();
        $empleados = Empleado::where('isEnable','=',1)->count();
        $productos = Producto::where('isEnable','=',1)->count();
        $role_name = Rol::select('name')->where('id','=',auth()->user()->id_role)->first();
        return view('home')
        ->with('ventas',$ventas)
        ->with('empleados',$empleados)
        ->with('productos',$productos)
        ->with('role_name',$role_name);
    }
}
