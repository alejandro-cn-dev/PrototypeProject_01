<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;

class ConfigController extends Controller
{
    public function get_params()
    {
        $valores = Parametro::all();
        $ruta_icono = Parametro::where('nombre','=','logo_sistema_path')->get()[0]->valor;
        return view('config')->with('valores',$valores)->with('ruta_icono',$ruta_icono);
    }
    public function get_param($id)
    {
        $valor = Parametro::find($id);
        return view('setconfig')->with('config',$valor);
    }
    public function up_params(Request $request,$id)
    {
        //$parametro = new Parametro();
        $parametro = Parametro::find($id);
        //$parametro->nombre = $request->get('nombre');
        $parametro->valor = $request->get('valor');
        $parametro->save();

        return redirect('/config');
    }
}
