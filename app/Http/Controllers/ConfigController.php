<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:panel-config-admin')->only('get_params','get_param','up_params');
        $this->middleware('can:panel-config-dev')->only('dev_params');
    }
    public function get_params()
    {
        //$valores = Parametro::all();
        $valores = DB::table('parametros')
            ->select(DB::raw('id, nombre, LEFT(valor, 20) AS valor_mini, descripcion'))
            ->get();
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
    public function dev_params()
    {
        return view('dev_config');
    }
}
