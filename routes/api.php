<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FoodController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ActivityLevelController;
use App\Http\Controllers\AGController;
use App\Http\Controllers\CMVColController;
use App\Http\Controllers\AminoacidController;

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

Route::group(['middleware' => ['auth:api']], function() {

    Route::apiResource('/food', FoodController::class)->except(['destroy']);

    Route::apiResource('/category', CategoryController::class)->except(['destroy']);

    Route::prefix('category')->group(function () {
        Route::get('/{category}/food', [CategoryController::class, 'categoryFoods'])->name('category_foods');
    });

    Route::apiResource('/activitylevel', ActivityLevelController::class)->except(['destroy']);

    Route::apiResource('/ag', AGController::class)->except(['destroy']);

    Route::apiResource('/cmvcol', CMVColController::class)->except(['destroy']);

    Route::apiResource('/aminoacid', AminoacidController::class)->except(['destroy']);
});

