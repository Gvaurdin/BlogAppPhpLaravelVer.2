<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator as PaginatorAlias;
use Illuminate\Support\ServiceProvider;
use Nette\Utils\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PaginatorAlias::useBootstrap();
    }
}
