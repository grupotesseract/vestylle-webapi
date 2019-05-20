<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $repositorio = new \App\Repositories\CategoriaRepository(app());
        $categorias = $repositorio->getCategoriasSelect();
        \View::composer('categorias.partials.select', '\App\ViewComposers\CategoriaComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
