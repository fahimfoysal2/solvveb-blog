<?php

namespace App\Providers;

use App\Repository\Interfaces\IEloquentRepository;
use App\Repository\Interfaces\IUserRepository;
use App\Repository\Repositories\BaseRepository;
use App\Repository\Repositories\CategoryRepository;
use App\Repository\Interfaces\ICategoryRepository;
use App\Repository\Repositories\UserRepository;
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
        $this->app->bind(IEloquentRepository::class, BaseRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
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
