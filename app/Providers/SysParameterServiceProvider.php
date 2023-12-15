<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        if (Schema::hasTable('parametros')) {
            $parametros = Parametro::select('valor')->whereIn('nombre',['nombre_sistema','version_sistema','logo_sistema_path'])->where('isDeleted','=',0)->get();
            $nombre = 'Default';
            $version = 'Default';
            $logo = 'vendor/adminlte/dist/img/AdminLTELogo.png';
            if(!empty($parametros[0]->valor) && !empty($parametros[1]->valor) && !empty($parametros[2]->valor))
            {
                $nombre = $parametros[0]->valor;
                $version = $parametros[1]->valor;
                $logo = $parametros[2]->valor;
            }
            config(['adminlte.title' => 'Sistema Web | '.$nombre.' | '.$version]);
            config(['adminlte.logo' => '<b>'.$nombre.'</b>']);
            config(['adminlte.logo_img' => $logo]);
            config(['adminlte.auth_logo.img.path' => $logo]);
            config(['system_name' => $nombre]);
            config(['system_version' => $version]);
        }
    }
}
