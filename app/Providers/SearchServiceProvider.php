<?php

namespace App\Providers;

use App\Library\Search\SearchElastic;
use App\Library\Search\SearchInterface;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SearchInterface::class, function ($app) {
            return new SearchElastic($app->config->get('search'));
        });
    }
}
