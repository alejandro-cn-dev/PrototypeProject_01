<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
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
            ->select('id', 'nombre', DB::raw('LEFT(valor, 20) AS valor_mini'), 'descripcion')
            ->where('parametros.access_level','=',2)
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
        //$parametros = Parametro::select('valor')->whereIn('nombre',['titulo_comprobante_venta','fecha_compra_venta'])->get();
        $titulo_comprobante = Parametro::find(17);
        $campo_fecha = Parametro::find(16);
        return view('dev_config',['titulo_comprobante'=>$titulo_comprobante->valor,'campo_fecha'=>$campo_fecha->valor]);
    }
    public function set_dev_params(Request $request)
    {
        //return response()->json(['status'=>'error','msg'=>$request->name]);
        $mensaje = '';
        try {
            //if ($request->get('name') == 'titulo_comprobante') {
            if ($request->name == 'titulo_comprobante') {
                //config(['dev_opt_venta_report_title' => $request->value]);
                //config()->set('dev_opt_venta_report_title',$request->value);
                //Config::set('dev_opt_venta_report_title','AAAA');
                //$titulo_param = Parametro::where('nombre','=','titulo_comprobante_venta')->first();
                $titulo_param = Parametro::find(17);
                $titulo_param->valor = $request->value;
                $titulo_param->save();

                $mensaje = 'Ha cambiado el titulo de comprobante de venta';
            }
            if ($request->name == 'campo_fecha') {
                //config(['dev_opt_fecha_compra_venta' => $request->value]);
                $campo = Parametro::find(16);
                $campo->valor = strval($request->value);
                $campo->save();
                if($request->value == 'true'){
                    $mensaje = 'El campo "fecha" aparece en los formularios de compra y venta';
                }else{
                    $mensaje = 'El campo "fecha" ya no aparecerá en los formularios de compra y venta';
                }
            }
            return response()->json(['status'=>'success','msg'=>$mensaje]);

        } catch (Exception $th) {
            return response()->json(['status'=>'error','msg'=>$th]);
        }
    }
    public function vaciar_db(){
        try {
            Artisan::call("migrate:fresh");
            Artisan::call("db:seed");
            $output = Artisan::output();
            return response()->json(['status'=>'success','msg'=>$output]);
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error','msg'=>$th]);
        }
    }
}
