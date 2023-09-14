<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        if (App::environment('production')) {
            URL::forceScheme('https');
        }

        // Recuperar el nombre del sistema
        $val1 = Parametro::where('isDeleted','=',0)->where('nombre','=','nombre_sistema')->get();
        $nombre_sistema = $val1->last()->valor;
        App::singleton('nombre_sistema', function() use ($valor) {
            return $nombre_sistema;
        });
    }
}
