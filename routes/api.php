<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EscapeRoomController;
use App\Http\Controllers\API\TimeSlotController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::get('/escape-rooms', [EscapeRoomController::class, 'index']);
Route::get('/escape-rooms/{id}', [EscapeRoomController::class, 'show']);
Route::get('/escape-rooms/{id}/time-slots', [TimeSlotController::class, 'index']);

// Authentication routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Booking routes
    Route::post('/bookings', [BookingController::class,'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class,'index']);
    Route::delete('/bookings/{id}', [BookingController::class,'destroy']);
    // User profile route
    Route::get('/profile', [UserController::class,'profile']);
});
