<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController as PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('register', [AuthController::class, 'register']);

Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{id}',[PostController::class,'show'])->middleware('auth:sanctum');
Route::post('/posts',[PostController::class,'store'])->middleware('auth:sanctum');
Route::put('/posts/{id}',[PostController::class,'update'])->middleware('auth:sanctum');
Route::delete('/posts/{id}',[PostController::class,'destroy'])->middleware('auth:sanctum');
