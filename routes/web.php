<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\Admin\Auth\LoginController as AdminLoginController; 
use App\Http\Controllers\Backend\User\UserProfoileController;
use App\Http\Controllers\Backend\Admin\DashboardController;


Auth::routes();

// Admin login route
Route::group([ 'prefix' =>'admin', 'as' => 'admin.'], function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'loginPost'])->name('login.post');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout')->middleware('auth:admin');
});

// USER ROUTES
Route::group(['middleware' => ['auth:web'], 'prefix' =>'user', 'as' => 'user.'], function () {
    Route::get('/profile', [UserProfoileController::class, 'profile'])->name('profile');
});

Route::group(['middleware' => ['auth:admin'], 'prefix' =>'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

// FRONTEND ROUTES
Route::group([ 'as' => 'f.'], function () {
Route::get('/', [HomeController::class, 'index'])->name('home');
});

