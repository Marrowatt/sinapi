<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NutritionistController;
use App\Http\Controllers\RegularController;
use App\Http\Controllers\FoodController;

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
    return view('index');
});

Auth::routes();

Route::group(['prefix' => 'regular', 'middleware' => ['isRegular', 'auth']], function () {
    Route::get('dashboard', [RegularController::class, 'index'])->name('regular.dashboard');
    Route::get('profile', [RegularController::class, 'profile'])->name('regular.profile');
    Route::put('profile/{user}', [RegularController::class, 'profile_update'])->name('regular.profile.update');
    Route::put('profile-password', [RegularController::class, 'profile_password_update'])->name('regular.profile.password');
});

Route::group(['prefix' => 'nutritionist', 'middleware' => ['isNutritionist', 'auth']], function () {
    Route::get('dashboard', [NutritionistController::class, 'index'])->name('nutritionist.dashboard');
    Route::get('profile', [NutritionistController::class, 'profile'])->name('nutritionist.profile');
    Route::put('profile/{user}', [NutritionistController::class, 'profile_update'])->name('nutritionist.profile.update');
    Route::put('profile-password', [NutritionistController::class, 'profile_password_update'])->name('nutritionist.profile.password');
    Route::get('patients', [NutritionistController::class, 'patients'])->name('nutritionist.patients');
    Route::get('/getPatients', [NutritionistController::class, 'getPatients'])->name('get_patients');
});

Route::get('getFood', [FoodController::class, 'getFood'])->name('getFood');

Route::get('getOneFood/{id}', [FoodController::class, 'getOneFood'])->name('getOneFood');