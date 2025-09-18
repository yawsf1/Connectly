<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home', [PostController::class, 'home'])->name('home');
    Route::post('/makingPost', [PostController::class, 'makingPost'])->name('makingPost');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('inscription');
    })
    ->name('registerPage');

    Route::get('/login', function () {
        return view('login');
    })
    ->name('loginPage');

    Route::post('/login', [UserController::class, 'login'])->name('login');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

Route::get('/auth/google', [UserController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [UserController::class, 'handleGoogleCallback']);
