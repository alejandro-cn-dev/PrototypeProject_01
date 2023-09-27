<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;

class ConfigController extends Controller
{
    public function get_params()
    {
        $valores = Parametro::all();
        return view('config')->with('valores',$valores);
    }
    public function up_params(Request $request)
    {
        $parametro = new Parametro();
        $parametro->nombre = $request->get('nombre');
        $parametro->valor = $request->get('valor');
        $parametro->save();

        return redirect('/params');
    }
}
