<?php
    namespace Data;
    
    use App\Models\Parametro;
    use Illuminate\Support\Facades\DB;

    class DatosClass
    {
        public static function ObtenerDatos()
        {
            //$aux = Parametro::where('nombre','LIKE','nombre_sistema')->get();
            $aux = DB::select('select valor from parametros where nombre LIKE "nombre_sistema"');
            //$aux = 'Presitexx1';
            return $aux;
            //return 'Presitexx';
        }        
    }
?>