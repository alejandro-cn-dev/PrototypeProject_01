<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use Exception;
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
        $titulo_comprobante = config('dev_opt_venta_report_title');
        $campo_fecha = config('dev_opt_fecha_compra_venta');
        return view('dev_config',['titulo_comprobante'=>$titulo_comprobante,'campo_fecha'=>$campo_fecha]);
    }
    public function set_dev_params(Request $request)
    {
        $mensaje = '';
        try {
            if ($request->get('name') == 'titulo_comprobante') {
                config(['dev_opt_venta_report_title' => $request->get('value')]);
                $mensaje = 'Ha cambiado el titulo de comprobante de venta';
            }
            if ($request->get('name') == 'campo_fecha') {
                config(['dev_opt_fecha_compra_venta' => $request->get('value')]);
                if($request->get('value') == true){
                    $mensaje = 'El campo "fecha" aparece en los fomularios de compra y venta';
                }else{
                    $mensaje = 'El campo "fecha" ya no aparecerá en los formularios de compra y venta';
                }
            }
            return response()->json(['status'=>'success','msg'=>$mensaje]);
        } catch (Exception $th) {
            return response()->json(['status'=>'error','msg'=>$th]);
        }
    }
}
