<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CurrencyInterface;
use App\Interfaces\AccountInterface;
use App\Repositories\CurrencyRepository;
use App\Repositories\AccountRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("App\Interfaces\AccountInterface", "App\Repositories\AccountRepository");
        $this->app->bind(CurrencyInterface::class, CurrencyRepository::class);
    }
}
