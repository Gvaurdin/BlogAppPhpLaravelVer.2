<?php

use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\IndexController as AdminIndexController;
use App\Http\Controllers\admin\PostController as AdminPostController;
use App\Http\Controllers\admin\UserController as UserController;
use App\Http\Controllers\AuthSocialAuthController as AuthSocialAuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/posts', function () {
//    return view('welcome');
//});
Route::view('/', 'index')->name('home');
Route::get('/auth/github', [AuthSocialAuthController::class, 'redirectToGitHub'])->name('github.login');
Route::get('/auth/github/callback', [AuthSocialAuthController::class, 'handleGitHubCallback']);

Route::name('posts.')
    ->middleware(['auth'])
    ->prefix('posts')
    ->group(function () {
        Route::name('categories.')
            ->prefix('categories')
            ->group(function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('index');
                Route::get('/{id}', [CategoriesController::class, 'show'])->name('show');
            });
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::post('/{post}/add/like', [PostController::class, 'addLike'])->name('like.add');
        Route::get('/', [PostController::class, 'index'])->name('index');
    });

Route::name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index');

        Route::name('categories.')
            ->prefix('categories')
            ->group(function () {
                Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
                Route::get('/create', [AdminCategoryController::class, 'create'])->name('create');
                Route::get('/{category}', [AdminCategoryController::class, 'show'])->name('show');
                Route::get('/edit/{category}', [AdminCategoryController::class, 'edit'])->name('edit');
                Route::get('/delete/{category}', [AdminCategoryController::class, 'delete'])->name('delete');
                Route::match(['POST', 'PUT', 'DELETE'], '/store', [AdminCategoryController::class, 'store'])->name('store');
            });
        Route::name('posts.')
            ->prefix('posts')
            ->group(function () {
                Route::get('/', [AdminPostController::class, 'index'])->name('index');
                Route::get('/create', [AdminPostController::class, 'create'])->name('create');
                Route::get('/edit/{post}', [AdminPostController::class, 'edit'])->name('edit');
                Route::get('/delete/{post}', [AdminPostController::class, 'delete'])->name('delete');
                Route::match(['POST', 'PUT'], '/store', [AdminPostController::class, 'store'])->name('store');
                Route::delete('/deletePost', [AdminPostController::class, 'deletePost'])->name('deletePost');
            });
        Route::name('users.')
            ->prefix('users')
            ->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
                Route::get('/delete/{user}', [UserController::class, 'delete'])->name('delete');
                Route::match(['POST', 'PUT'], '/store', [UserController::class, 'store'])->name('store');
                Route::delete('/deleteUser', [UserController::class, 'deleteUser'])->name('deleteUser');
            });
    });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
