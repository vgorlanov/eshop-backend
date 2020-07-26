<?php

namespace App\Providers;

use App\Infrastructure\Repositories\Product\ElasticRepository;
use App\Infrastructure\Repositories\Product\EloquentRepository;
use App\Infrastructure\Repositories\Product\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepository::class, function () {
            if(config('search.repository')) {
                return new ElasticRepository();
            }
            return new EloquentRepository();
        });
    }
}
