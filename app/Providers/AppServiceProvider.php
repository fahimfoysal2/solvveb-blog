<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Key too long error
        Schema::defaultStringLength(191);

        Paginator::useBootstrap();

        // demo data for sidebar
        $sidebar_data = [
            'recent_post' => [
                'title' => "Test Post",
                'details' => "This is leatest post"
            ],
            'categories' => ['Tech', 'Tutorial'],
            'tags' => ['tutorial', 'laravel', 'tag 3'],
        ];

        View::share('sidebar_data', $sidebar_data);
    }
}
