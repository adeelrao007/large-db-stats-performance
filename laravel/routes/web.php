<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Not a single web route";
});

// Health check route
Route::get('/health', function () {
    return response()->json(['status' => 'ok'], 200);
});
