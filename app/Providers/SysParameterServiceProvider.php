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
        //$a = 'app/SystemValues.json';
        $this->app->singleton('SystemValuesService', function () {
            return new SystemValuesService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(SystemValuesService $settinsInstance)
    {
        // $this->app->singleton('nombre_sistema', function ($app) {
        //     return new ManageParameters().getValues()->value('nombre_sistema');
        // });
        //Recuperar el nombre del sistema
        // $val1 = Parametro::where('isDeleted','=',0)->where('nombre','=','nombre_sistema')->get();
        // $nombre_sistema = $val1->last()->valor;
        View::share('globalsettings', $settinsInstance);
    }
}

//use Illuminate\Support\Facades\DB;

class SystemValuesService
{
    protected $configValues;
    protected $pathParams;
    public function __construct()
    {
        $this->pathParams = env('APP_PATH_PARAMS', false);
        //$this->pathParams = 'app/Parameters/SystemValues.json';
        $this->configValues = json_decode(file_get_contents($this->pathParams), true);
        config($this->configValues);
    }
    public function getConfigValue($nombre)
    {        
        return $this->configValues[$nombre];
    }
}
