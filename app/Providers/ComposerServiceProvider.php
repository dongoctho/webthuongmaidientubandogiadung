<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('*', function ($view)
        {
            $categories = Category::all();
            $admin = auth()->user();

            view()->share([
                'admin'=> $admin,
                'categories' => $categories
            ]);
        });
    }
}
