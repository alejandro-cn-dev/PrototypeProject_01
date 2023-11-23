<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use App\Models\Parametro;
use App\Models\GlobalSettings;
use Cache;

class SysParameterServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('parametros')) {
            $parametros = Parametro::select('valor')->whereIn('nombre',['nombre_sistema','version_sistema'])->where('isDeleted','=',0)->get();
            $nombre = 'Default';
            $version = 'Default';
            if(!empty($parametros[0]->valor) && !empty($parametros[1]->valor))
            {
                $nombre = $parametros[0]->valor;
                $version = $parametros[1]->valor;
            }            
            config(['adminlte.title' => 'Sistema Web | '.$nombre.' | '.$version]);
            config(['adminlte.logo' => '<b>'.$nombre.'</b>']);        
            config(['system_name' => $nombre]);
            config(['system_version' => $version]);
        }
    }
}