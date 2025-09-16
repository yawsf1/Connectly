<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::apiResource('/posts', PostController::class);
