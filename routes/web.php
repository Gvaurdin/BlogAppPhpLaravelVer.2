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

Route::get('auth/{provider}', [AuthSocialAuthController::class, 'redirectToProvider'])->name('auth.redirect');
Route::get('auth/{provider}/callback', [AuthSocialAuthController::class, 'handleProviderCallback'])->name('auth.callback');

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
                Route::post('/store', [AdminCategoryController::class, 'store'])->name('store');
                Route::get('/{category}', [AdminCategoryController::class, 'show'])->name('show');
                Route::get('/{category}/edit', [AdminCategoryController::class, 'edit'])->name('edit');
                Route::put('/{category}/update', [AdminCategoryController::class, 'update'])->name('update');
                Route::delete('/{category}/delete', [AdminCategoryController::class, 'delete'])->name('delete');
            });
        Route::name('posts.')
            ->prefix('posts')
            ->group(function () {
                Route::get('/', [AdminPostController::class, 'index'])->name('index');
                Route::get('/create', [AdminPostController::class, 'create'])->name('create');
                Route::post('/store', [AdminPostController::class, 'store'])->name('store');
                Route::get('/edit/{post}', [AdminPostController::class, 'edit'])->name('edit');
                Route::put('/{post}/update', [AdminPostController::class, 'update'])->name('update');
                Route::delete('/{post}/delete', [AdminPostController::class, 'delete'])->name('delete');
            });
        Route::name('users.')
            ->prefix('users')
            ->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
                Route::get('/delete/{user}', [UserController::class, 'delete'])->name('delete');
                Route::post('/store', [UserController::class, 'store'])->name('store');
                Route::put('/{user}/update', [UserController::class, 'update'])->name('update');
                Route::delete('/{user}/delete', [UserController::class, 'delete'])->name('delete');
            });
    });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
