<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NutritionistController;
use App\Http\Controllers\RegularController;
use App\Http\Controllers\AdminController;

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

Route::group(['prefix' => 'nutritionist', 'middleware' => ['isNutritionist', 'auth']], function () {
    Route::get('dashboard', [NutritionistController::class, 'index'])->name('nutri.dashboard');
    Route::get('profile', [NutritionistController::class, 'profile'])->name('nutri.profile');
});

Route::group(['prefix' => 'regular', 'middleware' => ['isRegular', 'auth']], function () {
    Route::get('dashboard', [RegularController::class, 'index'])->name('regular.dashboard');
    Route::get('profile', [RegularController::class, 'profile'])->name('regular.profile');
    Route::put('profile/{user}', [RegularController::class, 'profile_update'])->name('regular.profile.update');
    Route::put('profile-password', [RegularController::class, 'profile_password_update'])->name('regular.profile.password');
});

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth']], function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
});