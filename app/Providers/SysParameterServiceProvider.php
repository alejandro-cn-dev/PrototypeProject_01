<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton('nombre_sistema', function ($app) {
            return new ManageParameters().getValues()->value('nombre_sistema');
        });
    }
}

use Illuminate\Support\Facades\DB;

class ManageParameters
{
    public function getValues()
    {
        return DB::table('parametros')->get();
    }
    public function getName()
    {
        return DB::table('parametros')->get()->value('nombre_sistema');
    }
}
