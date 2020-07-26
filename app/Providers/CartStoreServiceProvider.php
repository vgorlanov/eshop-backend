<?php

namespace App\Providers;

use App\Library\Cart\CartStoreInterface;
use App\Library\Cart\RedisCartStore;
use Illuminate\Support\ServiceProvider;

class CartStoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CartStoreInterface::class, function ($app) {
            return new RedisCartStore();
        });
    }

}
