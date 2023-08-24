<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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

    public $bindings = [
        \App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\CategoryRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\UserRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\UserRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\CartDetailRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\CartDetailRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\CartRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\CartRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\ManufactureRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\ManufactureRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\OrderDetailRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\OrderRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\ProductRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\StorageRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\StorageRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\VoucherRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\VoucherRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\PasswordResetRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\PasswordResetRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
