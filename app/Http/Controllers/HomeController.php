<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta_cabecera;
use App\Models\Compra_cabecera;
use App\Models\User;
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
        $ventas = Venta_cabecera::where('isDeleted','=',0)->count();
        $compras = Compra_cabecera::where('isDeleted','=',0)->count();
        $empleados = User::where('isDeleted','=',0)->count();
        $productos = Producto::where('isDeleted','=',0)->count();
        return view('home')
        ->with('ventas',$ventas)
        ->with('compras',$compras)
        ->with('empleados',$empleados)
        ->with('productos',$productos);
    }
}
