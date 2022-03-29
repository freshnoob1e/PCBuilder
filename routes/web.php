<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\BrowseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartController;
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

// All
Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcbuilder', function () {
    return view('pc-builder');
})->name('pc-builder');

Route::get('/pcbuilder/guide', function () {
    return view('pc-builder-guide');
})->name('pc-builder-guide');

Route::get('/aboutus', function () {
    return view('about-us');
})->name('about-us');

Route::controller(BrowseController::class)->group(function () {
    Route::get('/components', 'components_index')->name('browse-components');
    Route::get('/brands', 'brands_index')->name('browse-brands');
    Route::get('/categories', 'categories_index')->name('browse-categories');
    Route::get('/component/{part}', 'component_show')->name('show-component');
    Route::get('/brand/{brand}', 'brand_show')->name('show-brand');
    Route::get('/category/{category}', 'category_show')->name('show-category');
});

// Authenticated only
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/forum', 'index')->name('forum');
        Route::post('/post', 'store')->name('post-store');
        Route::get('/post/{post}/edit', 'edit')->name('post-edit');
        Route::patch('/post/{post}', 'update')->name('post-update');
        Route::get('/post/{post}', 'show')->name('post');
        Route::delete('/post/{post}', 'destroy')->name('post-destroy');
        Route::patch('/post/like/{post}', 'like')->name('post-like');
    });

    Route::controller(PostCommentController::class)->group(function () {
        Route::post('/post/{post}/comment', 'store')->name('comment-store');
        Route::delete('/post/{post}/comment/{comment}', 'destroy')->name('comment-destroy');
    });

    Route::controller(ChatroomController::class)->group(function () {
        Route::get('/chats', 'index')->name('chat-index');
        Route::get('/chat/{user}', 'show')->name('chat-show');
        Route::post('/chat/{user}', 'startChat')->name('chat-start');
    });

    Route::post('/chat/message/{sender_id}/{target_id}', [MessageController::class, 'store'])->name('message-store');
});

// Admin only
Route::middleware(['auth:sanctum', 'verified', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin-dashboard');

    Route::controller(UserController::class)->group(function () {
        Route::get('/admin/users', 'index')->name('admin-users-index');
        Route::get('/admin/user/{user}', 'edit')->name('admin-users-edit');
        Route::patch('/admin/user/{user}', 'update')->name('admin-users-update');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/admin/roles', 'index')->name('admin-roles-index');
        Route::delete('/admin/{user}/roles', 'destroy')->name('admin-users-role-destroy');
    });

    Route::controller(PartController::class)->group(function () {
        Route::get('/admin/parts', 'index')->name('admin-parts-index');
        Route::get('/admin/part/create', 'create')->name('admin-parts-create');
        Route::get('/admin/part/edit/{part}', 'edit')->name('admin-parts-edit');
        Route::get('/admin/part/{part}', 'show')->name('admin-parts-show');
        Route::get('/admin/part/compatibility/{part}', 'manageCompat')->name('admin-parts-manage-compat');
        Route::post('/admin/part', 'store')->name('admin-parts-store');
        Route::patch('/admin/part/{part}', 'update')->name('admin-parts-update');
        Route::delete('/admin/part/{part}', 'destroy')->name('admin-parts-destroy');
    });

    Route::controller(BrandController::class)->group(function () {
        Route::get('/admin/brands', 'index')->name('admin-brands-index');
        Route::get('/admin/brand/create', 'create')->name('admin-brands-create');
        Route::get('/admin/brand/edit/{brand}', 'edit')->name('admin-brands-edit');
        Route::get('/admin/brand/{brand}', 'show')->name('admin-brands-show');
        Route::post('/admin/brand', 'store')->name('admin-brands-store');
        Route::patch('/admin/brand/{brand}', 'update')->name('admin-brands-update');
        Route::delete('/admin/brand/{brand}', 'destroy')->name('admin-brands-destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/categories', 'index')->name('admin-categories-index');
        Route::get('/admin/category/create', 'create')->name('admin-categories-create');
        Route::get('/admin/category/edit/{category}', 'edit')->name('admin-categories-edit');
        Route::get('/admin/category/{category}', 'show')->name('admin-categories-show');
        Route::post('/admin/category', 'store')->name('admin-categories-store');
        Route::patch('/admin/category/{category}', 'update')->name('admin-categories-update');
        Route::delete('/admin/category/{category}', 'destroy')->name('admin-categories-destroy');
    });
});
