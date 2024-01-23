<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\View;
use App\Categoria;

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
        View::share('menu_categorias', Categoria::where('ativo',1)->get()->toHierarchy());
        //
        $categories    = '';
        $allCategories = Categoria::where('ativo',1)->get()->toHierarchy();
        foreach ($allCategories as $node) {
            $categories .= Categoria::buildCatForMenu($node);
        }
        

        View::share('menu_categorias_cats', $categories);
    }
}
