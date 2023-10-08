<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\Parametro;
use App\Models\GlobalSettings;

class SysParameterServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Intento #1
        // //App::singleton('App\GlobalSettings', function($app){
        // App::singleton(GlobalSettings::class, function($app){
        // //$this->app->singleton(GlobalSettings::class, function ($app) {
        //     return new GlobalSettings(Parametro::all());
        // });
        // Intento #2 (espero que el último)
        $this->app->singleton('SystemValuesService', function () {
            return new SystemValuesService(DB::connection());
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(GlobalSettings $settinsInstance)
    {
        // $this->app->singleton('nombre_sistema', function ($app) {
        //     return new ManageParameters().getValues()->value('nombre_sistema');
        // });
        //Recuperar el nombre del sistema
        // $val1 = Parametro::where('isDeleted','=',0)->where('nombre','=','nombre_sistema')->get();
        // $nombre_sistema = $val1->last()->valor;
        //View::share('globalsettings', $settinsInstance);
    }
}

use Illuminate\Support\Facades\DB;

class SystemValuesService
{
    public function __construct(DB $db)
    {
        $this->db = $db;
    }
    public function getValues()
    {
        //return $this->db->table('parametros')->get();
        $values = DB::table('values')->get();
        return $values->toArray();
    }
    // public function getValues()
    // {
    //     return DB::table('parametros')->get();
    // }
    // public function getName()
    // {
    //     return DB::table('parametros')->get()->value('nombre_sistema');
    // }
}
