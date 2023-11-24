<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Conta\IContaRepository;
use App\Repositories\Conta\ContaRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Conta\IContaRepository',
            'App\Repositories\Conta\ContaRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
