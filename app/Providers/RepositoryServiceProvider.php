<?php

namespace App\Providers;

use App\Repository\Interfaces\ICommentRepository;
use App\Repository\Interfaces\IEloquentRepository;
use App\Repository\Interfaces\IPostRepository;
use App\Repository\Interfaces\ITagRepository;
use App\Repository\Interfaces\IUserRepository;
use App\Repository\Repositories\BaseRepository;
use App\Repository\Repositories\CategoryRepository;
use App\Repository\Interfaces\ICategoryRepository;
use App\Repository\Repositories\CommentRepository;
use App\Repository\Repositories\PostRepository;
use App\Repository\Repositories\TagRepository;
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
        $this->app->bind(ITagRepository::class, TagRepository::class);
        $this->app->bind(IPostRepository::class, PostRepository::class);
        $this->app->bind(ICommentRepository::class, CommentRepository::class);

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
