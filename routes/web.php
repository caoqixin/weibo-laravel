<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\EmailVerifyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth'])
        ->middleware(['throttle:6,1'])
        ->name('login.auth');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])
        ->middleware(['throttle:10,60'])
        ->name('register.create');

    // 重置密码
    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->middleware(['throttle:3,10'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])
        ->middleware(['throttle:3,10'])
        ->name('password.update');
});


Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');


Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class)->middleware('verified');

    Route::get('/users/{user}/followings', [UserController::class, 'followings'])->name('users.followings');
    Route::get('/users/{user}/fans', [UserController::class, 'fans'])->name('users.fans');

    Route::post('/users/followers/{user}', [FollowersController::class, 'store'])->name('followers.store');
    Route::delete('/users/followers/{user}', [FollowersController::class, 'destroy'])->name('followers.destroy');

    Route::delete('/logout', [LoginController::class, 'logout'])->name('login.logout');

    // 邮箱验证
    Route::get('/email/verify', [EmailVerifyController::class, 'verify'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'emailVerification'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerifyController::class, 'sendEmail'])
        ->middleware(['throttle:3,1'])
        ->name('verification.send');

    Route::resource('/articles', ArticleController::class, ['only' => ['store', 'destroy']])
        ->middleware('verified');
});
