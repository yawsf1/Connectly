<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home', [PostController::class, 'home'])->name('home');
    Route::post('/makingPost', [PostController::class, 'makingPost'])->name('makingPost');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    
    Route::get('/myPosts', [PostController::class, 'myPosts'])->name('myPosts');
    
    Route::get('/myNotifications', [NotificationController::class, 'index'])->name('myNotifications');
    Route::put('/notifications/{id}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');

    Route::get('/myFriends', [FriendController::class, 'index'])->name('myFriends');
    Route::post('/friends', [FriendController::class, 'store'])->name('friends.store');
    Route::put('/friends/{id}', [FriendController::class, 'update'])->name('friends.update');
    Route::delete('/friends/{id}', [FriendController::class, 'destroy'])->name('friends.destroy');
    
    Route::get('/MyMessages', [MessageController::class, 'index'])->name('MyMessages');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');

    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::get('/profile', [UserController::class, 'settings'])->name('profile');
    Route::put('/settings', [UserController::class, 'updateSettings'])->name('settings.update');


    Route::delete('/settings/delete-account', [UserController::class, 'deleteAccount'])
    ->name('settings.deleteAccount');
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
