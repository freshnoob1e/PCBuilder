<?php

use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
Route::middleware(['auth:sanctum', 'verified'])->get('/post/{post}/edit', [PostController::class, 'edit'])
    ->name('post-edit');
Route::middleware(['auth:sanctum', 'verified'])->patch('/post/{post}', [PostController::class, 'update'])
    ->name('post-update');
Route::middleware(['auth:sanctum', 'verified'])->get('/post/{post}', [PostController::class, 'show'])
    ->name('post');
Route::middleware(['auth:sanctum', 'verified'])->delete('/post/{post}', [PostController::class, 'destroy'])
    ->name('post-destroy');
Route::middleware(['auth:sanctum', 'verified'])->patch('/post/like/{post}', [PostController::class, 'like'])
    ->name('post-like');

Route::middleware(['auth:sanctum', 'verified'])->post('/post/{post}/comment', [PostCommentController::class, 'store'])
    ->name('comment-store');
Route::middleware(['auth:sanctum', 'verified'])->delete('/post/{post}/comment/{comment}', [PostCommentController::class, 'destroy'])
    ->name('comment-destroy');

Route::middleware(['auth:sanctum', 'verified', 'role:Admin'])->get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('admin-dashboard');

Route::middleware(['auth:sanctum', 'verified', 'role:Admin'])->get('/admin/users', [UserController::class, 'index'])
    ->name('admin-users-index');
Route::middleware(['auth:sanctum', 'verified', 'role:Admin'])->get('/admin/user/{user}', [UserController::class, 'edit'])
    ->name('admin-users-edit');
Route::middleware(['auth:sanctum', 'verified', 'role:Admin'])->patch('/admin/user/{user}', [UserController::class, 'update'])
    ->name('admin-users-update');

Route::middleware(['auth:sanctum', 'verified', 'role:Admin'])->get('/admin/roles', [RoleController::class, 'index'])
    ->name('admin-roles-index');
Route::middleware(['auth:sanctum', 'verified', 'role:Admin'])->delete('/admin/{user}/roles', [RoleController::class, 'destroy'])
    ->name('admin-users-role-destroy');
