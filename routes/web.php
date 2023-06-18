<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmailVerifyController;
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
    Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.create');
});


Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');


Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class)->middleware('verified');
    Route::delete('/logout', [LoginController::class, 'logout'])->name('login.logout');

    // 邮箱验证
    Route::get('/email/verify', [EmailVerifyController::class, 'verify'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerifyController::class, 'emailVerification'])
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerifyController::class, 'sendEmail'])
        ->middleware(['throttle:6,1'])
        ->name('verification.send');
});
