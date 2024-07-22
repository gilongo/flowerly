<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Persistance\Eloquent\EloquentProductRepository;
use App\Infrastructure\Persistance\Eloquent\EloquentCustomerRepository;
use App\Infrastructure\Persistance\Eloquent\EloquentOrderRepository;

use App\Domain\Orders\Repositories\OrderRepositoryInterface;
use App\Domain\Products\Repositories\ProductRepositoryInterface;
use App\Domain\Customers\Repositories\CustomerRepositoryInterface;

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
        $this->app->bind(ProductRepositoryInterface::class, EloquentProductRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, EloquentCustomerRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);
    }
}
