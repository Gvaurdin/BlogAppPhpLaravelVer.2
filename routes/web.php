<?php

use App\Http\Controllers\Controllers\admin\IndexController as AdminController;
use App\Http\Controllers\Controllers\CategoriesController;
use App\Http\Controllers\Controllers\PostsController;
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
        Route::get('/', [PostsController::class, 'index'])->name('index');
        Route::get('/{slug}', [PostsController::class, 'show'])->name('show');

        Route::name('categories.')
            ->prefix('categories')
            ->group(function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('index');
                Route::get('/{id}', [CategoriesController::class, 'show'])->name('show');
            });
    });

Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/posts', [AdminController::class, 'post'])->name('posts');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::get('/addPost', [AdminController::class, 'addPostForm'])->name('addPostForm');
        Route::post('/addPost', [AdminController::class, 'addPost'])->name('addPost');
    });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
