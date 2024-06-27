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
            $parametros = Parametro::select('valor')->whereIn('nombre',['nombre_sistema','version_sistema','logo_sistema_path','localidad_empresa','direccion_empresa','correo_empresa','telefono_empresa','telefono_contacto'])->where('isDeleted','=',0)->get();

            $nombre = !empty($parametros[0]->valor)? $parametros[0]->valor: 'Default';
            $version = !empty($parametros[1]->valor)? $parametros[1]->valor: 'Default';
            $logo = !empty($parametros[2]->valor)? $parametros[2]->valor: 'vendor/adminlte/dist/img/AdminLTELogo.png';
            $localidad = !empty($parametros[3]->valor)? $parametros[3]->valor: 'Default';
            $direccion = !empty($parametros[4]->valor)? $parametros[4]->valor: 'Default';
            $correo = !empty($parametros[5]->valor)? $parametros[5]->valor: 'example@admin.com';
            $tel_empresa = !empty($parametros[6]->valor)? $parametros[6]->valor: '22000000';
            $tel_contacto = !empty($parametros[7]->valor)? $parametros[7]->valor: '22000000';

            config(['adminlte.title' => 'Sistema Web | '.$nombre.' | '.$version]);
            config(['adminlte.logo' => '<b>'.$nombre.'</b>']);
            config(['adminlte.logo_img' => $logo]);
            config(['adminlte.auth_logo.img.path' => $logo]);
            config(['system_name' => $nombre]);
            config(['system_version' => $version]);
            config(['system_location' => $localidad]);
            config(['system_address' => $direccion]);
            config(['system_email' => $correo]);
            config(['system_phone_business' => $tel_empresa]);
            config(['system_phone_contact' => $tel_contacto]);
        }
    }
}
