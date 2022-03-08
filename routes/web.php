<?php

use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/forum', [PostController::class, 'index'])
        ->name('forum');

Route::middleware(['auth:sanctum', 'verified'])->post('/post', [PostController::class, 'store'])
        ->name('post-store');

Route::middleware(['auth:sanctum', 'verified'])->get('/post/{post}', [PostController::class, 'show'])
        ->name('post');

Route::middleware(['auth:sanctum', 'verified'])->post('/post/{post}/comment', [PostCommentController::class, 'store'])
        ->name('comment-store');
