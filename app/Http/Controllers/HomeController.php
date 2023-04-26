<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta_cabecera;
use App\Models\Empleado;
use App\Models\Producto;

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
        return view('home')
        ->with('ventas',$ventas)
        ->with('empleados',$empleados)
        ->with('productos',$productos);
    }
}
