<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\CommentService;
use App\Services\IAuthService;
use App\Services\IBlogService;
use App\Services\ICategoryService;
use App\Services\ICommentService;
use App\Services\IPostService;
use App\Services\ITagService;
use App\Services\IUserService;
use App\Services\PostService;
use App\Services\TagService;
use App\Services\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        $this->app->bind(IAuthService::class, AuthService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(ITagService::class, TagService::class);
        $this->app->bind(IPostService::class, PostService::class);
        $this->app->bind(IBlogService::class, BlogService::class);
        $this->app->bind(ICommentService::class, CommentService::class);
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
