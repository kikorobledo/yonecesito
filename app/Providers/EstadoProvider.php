<?php

namespace App\Providers;

Use View;
use App\Estado;
use Illuminate\Support\ServiceProvider;

class EstadoProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            $estados = Estado::all();
            $view->with('estados', $estados);
        });
    }
}
