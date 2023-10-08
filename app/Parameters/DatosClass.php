<?php
    namespace Data;
    
    use App\Models\Parametro;
    use Illuminate\Support\Facades\DB;

    class DatosClass
    {
        public function __construct(DB $db)
        {
            $this->db = $db;
        }
        public static function ObtenerDatos()
        {
            //$aux = Parametro::where('nombre','LIKE','nombre_sistema')->get();
            //$aux = DB::select('select valor from parametros where nombre LIKE "nombre_sistema"');
            $aux = $this->db::table('parametros')->where('nombre','=','nombre_sistema')->get();
            //$aux = 'Presitexx1';
            return $aux->valor;
            //return 'Presitexx';
        }        
    }
?>