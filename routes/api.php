<?php
// Author: Chan Zheng Jie
use App\Http\Controllers\BrowseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(BrowseController::class)->group(function () {
    Route::get('/components', 'get_all_components');
    Route::get('/brands', 'get_all_brands');
    Route::get('/categories', 'get_all_categories');
    Route::get('/component/{part}', 'get_component');
    Route::get('/brand/{brand}', 'get_brand');
    Route::get('/category/{category}', 'get_category');
    Route::get('/components/json', 'get_all_components_json');
    Route::get('/brands/json', 'get_all_brands_json');
    Route::get('/categories/json', 'get_all_categories_json');
    Route::get('/component/{part}/json', 'get_component_json');
    Route::get('/brand/{brand}/json', 'get_brand_json');
    Route::get('/category/{category}/json', 'get_category_json');
});
