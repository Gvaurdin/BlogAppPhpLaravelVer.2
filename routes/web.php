<?php

use App\Http\Controllers\admin\IndexController as AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
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
        Route::get('/{id}', [PostsController::class, 'show'])->name('show');
        Route::get('/', [PostsController::class, 'index'])->name('index');
    });

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/posts', [AdminController::class, 'post'])->name('posts');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::get('/create', [AdminController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [AdminController::class, 'delete'])->name('delete');
        Route::match(['POST', 'PUT', 'DELETE'], '/store', [AdminController::class, 'store'])->name('store');
    });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
