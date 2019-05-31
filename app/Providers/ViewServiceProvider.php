<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        $repositorio = new \App\Repositories\CategoriaRepository(app());
        $categorias = $repositorio->getCategoriasSelect();
        \View::composer('categorias.partials.select', '\App\ViewComposers\CategoriaComposer');
    }
}
