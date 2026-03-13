<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// Public routes (no authentication required)
Route::post('/login', [LoginController::class, 'login']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    // Auth routes
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/user', [LoginController::class, 'user']);
    
    // Test route to verify authentication
    Route::get('/test-auth', function () {
        return response()->json([
            'message' => 'You are authenticated!',
            'user' => request()->user()->load('role', 'office')
        ]);
    });
});

// Optional: Test route for checking if API is working
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});