<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->middleware('can:viewAny,App\Models\User');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->middleware('can:view,user');

    Route::post('/users', [UserController::class, 'store'])
        ->middleware('permission:users.create');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->middleware('permission:users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->middleware('permission:users.delete');
});
