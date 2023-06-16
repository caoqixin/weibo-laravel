<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
Route::delete('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/', [StaticPagesController::class, 'home'])->name('home');
Route::get('/about', [StaticPagesController::class, 'about'])->name('about');
Route::get('/help', [StaticPagesController::class, 'help'])->name('help');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.create');

Route::middleware('auth')->group(function () {
    Route::resource('/users', UserController::class);
});
