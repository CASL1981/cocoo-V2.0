<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;   
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(125);

        Paginator::useBootstrap();

        Builder::macro('search', function($field, $string){
            return $string ? $this->orWhere($field, 'like', '%'.$string.'%') : $this;
        });

    }
}
