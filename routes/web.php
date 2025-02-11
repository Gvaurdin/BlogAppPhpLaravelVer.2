<?php

use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\IndexController as AdminIndexController;
use App\Http\Controllers\admin\PostController as AdminPostController;
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

Route::name('posts.')
    ->prefix('posts')
    ->group(function () {
        Route::name('categories.')
            ->prefix('categories')
            ->group(function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('index');
                Route::get('/{id}', [CategoriesController::class, 'show'])->name('show');
            });
        Route::get('/{post}', [PostController::class, 'show'])->name('show');
        Route::get('/', [PostController::class, 'index'])->name('index');
    });

Route::name('admin.')
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
                Route::match(['POST', 'PUT', 'DELETE'], '/store', [AdminPostController::class, 'store'])->name('store');
            });
    });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
