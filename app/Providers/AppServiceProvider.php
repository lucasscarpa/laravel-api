<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Conta\IContaRepository;
use App\Repositories\Conta\ContaRepository;
use App\Repositories\Transacao\TransacaoRepository;
use App\Repositories\Transacao\ITransacaoRepository;


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

        
        $this->app->bind(
            'App\Repositories\Transacao\ITransacaoRepository',
            'App\Repositories\Transacao\TransacaoRepository'
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
