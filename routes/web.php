<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
	
	
//------ HTTPS -------
if (App::environment('production')) {
    URL::forceScheme('https');
}
	
// ================== Landing ==================
Route::get('/welcome', function () {
    return view('welcome');
});

/**
 * @todo make route aliases, like: admin or dashboard
 *      will also take to admin panel home page
 */
Route::get('/dashboard', function () {
    $inspector = Gate::inspect('administrator');
    if (!$inspector->allowed()) {
        abort(403, $inspector->message());
    }
    return view('/admin/index');

})->name('dashboard')->middleware('auth');


// ================ Auth ==================

// login
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->back();
    } else return view('admin.auth.login');
})->name('login_view');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');

// register
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect()->back();
    } else return view('admin.auth.register');
})->name('register_view');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

// logout
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// password reset
Route::get('/password-reset', function () {
    return view('admin.auth.password-reset');
})->name('password-reset');


// ================== Functionality ==================


/**
 * 1. view blog listing - index page
 * 2. view Single blog post
 * 3. view blog categries
 * 4. save comment
 */
Route::get('/', [BlogController::class, 'viewBlogList'])->name('blog.home');
Route::get('/view/{post_title}', [BlogController::class, 'viewBlogPost'])->name('blog.post');
Route::get('/categories', [BlogController::class, 'viewCategories'])->name('blog.categories');
// @todo change this to blog.comment
Route::post('/comment', [BlogController::class, 'saveComment'])->name('comment.save');
Route::get('/category/{category_name}', [BlogController::class, 'categoryToPosts'])->name('blog.category.post');
Route::get('/tag/{tag_name}', [BlogController::class, 'tagToPosts'])->name('blog.tag.post');


/**
 * ==========================================
 * admin level routes with "Gate(administrator)"
 * ===========================================
 */
Route::prefix('manage')->middleware(['auth', 'can:administrator'])->group(function () {

    // make resource group routes
    Route::resources([
        'categories' => CategoryController::class,
        'tags' => TagController::class,
        'posts' => PostController::class,
    ]);

    // manage users
    Route::resource('users', UserController::class)->except([
        'create', 'store',
    ]);

    // json routes for: category, tag, user & post
    Route::get('/get-categories', [CategoryController::class, 'getAllCategories'])->name('getCategories');
    Route::get('/get-tags', [TagController::class, 'jsonTag'])->name('jsonTag');
    Route::get('/get-users', [UserController::class, 'jsonUserList'])->name('jsonUserList');
    Route::get('/get-posts', [PostController::class, 'jsonPostList'])->name('jsonPostList');

    // routes for select2 & searching
    Route::get('/category-search', [CategoryController::class, 'categorySearch'])->name('search-category');
    Route::get('/tag-search', [TagController::class, 'jsonTagSearch'])->name('search-tag');

    // json routes for comment model
    Route::get('/get-comments', [BlogController::class, 'jsonComment'])->name('jsonComment');
    Route::resource('comments', BlogController::class)->only([
        'index', 'show', 'update', 'destroy',
    ]);

});
