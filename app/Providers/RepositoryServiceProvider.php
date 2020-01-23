<?php

namespace App\Providers;

use App\Repositories\Interfaces\PecaRepositoryInterface;
use App\Repositories\PecaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PecaRepositoryInterface::class,
            PecaRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
