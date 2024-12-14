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
            //$parametros = Parametro::select('valor')->whereIn('nombre_sistema','razon_social','version_sistema','logo_sistema_path','localidad_empresa','direccion_empresa','correo_empresa','telefono_empresa','telefono_contacto','especializacion')->get();
            $parametros = Parametro::all();

            $nombre = !empty($parametros->where('nombre','=','nombre_sistema')->first()->valor)? $parametros->where('nombre','=','nombre_sistema')->first()->valor: 'Default';
            $razon_social = !empty($parametros->where('nombre','=','razon_social')->first()->valor)? $parametros->where('nombre','=','razon_social')->first()->valor: 'Default';
            $version = !empty($parametros->where('nombre','=','version_sistema')->first()->valor)? $parametros->where('nombre','=','version_sistema')->first()->valor: 'Default';
            $logo = !empty($parametros->where('nombre','=','logo_sistema_path')->first()->valor)? $parametros->where('nombre','=','logo_sistema_path')->first()->valor: 'vendor/adminlte/dist/img/AdminLTELogo.png';
            $localidad = !empty($parametros->where('nombre','=','localidad_empresa')->first()->valor)? $parametros->where('nombre','=','localidad_empresa')->first()->valor: 'Default';
            $direccion = !empty($parametros->where('nombre','=','direccion_empresa')->first()->valor)? $parametros->where('nombre','=','direccion_empresa')->first()->valor: 'Default';
            $correo = !empty($parametros->where('nombre','=','correo_empresa')->first()->valor)? $parametros->where('nombre','=','correo_empresa')->first()->valor: 'example@admin.com';
            $tel_empresa = !empty($parametros->where('nombre','=','telefono_empresa')->first()->valor)? $parametros->where('nombre','=','telefono_empresa')->first()->valor: '22000000';
            $tel_contacto = !empty($parametros->where('nombre','=','telefono_contacto')->first()->valor)? $parametros->where('nombre','=','telefono_contacto')->first()->valor: '22000000';
            $especializacion = !empty($parametros->where('nombre','=','especializacion')->first()->valor)? $parametros->where('nombre','=','especializacion')->first()->valor: 'Empresa especializada';

            // Configs del sistema
            config(['adminlte.title' => 'Sistema Web | '.$nombre.' | '.$version]);
            config(['adminlte.logo' => '<b>'.$nombre.'</b>']);
            config(['adminlte.logo_img' => $logo]);
            config(['adminlte.auth_logo.img.path' => $logo]);
            config(['system_name' => $nombre]);
            config(['system_name_denomination' => $razon_social]);
            config(['system_version' => $version]);
            config(['system_location' => $localidad]);
            config(['system_address' => $direccion]);
            config(['system_email' => $correo]);
            config(['system_phone_business' => $tel_empresa]);
            config(['system_phone_contact' => $tel_contacto]);
            config(['system_specialization' => $especializacion]);
        }
    }
}
