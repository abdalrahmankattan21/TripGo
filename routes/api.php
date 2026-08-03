<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Api\WaitingListController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Public Routes
Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/destinations/{destination}', [DestinationController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/trips', [TripController::class, 'index']);
Route::get('/trips/{trip}', [TripController::class, 'show']);

// Auth Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// User Profile
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
Route::get('/bookings', [BookingController::class, 'index']);
Route::get('/bookings/{booking}', [BookingController::class, 'show']);
Route::post('/trips/{trip}/bookings', [BookingController::class, 'store']);
Route::patch('/bookings/{booking}', [BookingController::class, 'cancel']);

Route::get('/waiting-lists', [WaitingListController::class, 'index']);
Route::get('/waiting-lists/{waitingList}', [WaitingListController::class, 'show']);
Route::delete('/waiting-lists/{waitingList}', [WaitingListController::class, 'destroy']);
});


Route::get('/trips/{trip}/reviews', [ReviewController::class, 'index']);


Route::middleware('auth:api')->group(function () {
    Route::post('/trips/{trip}/reviews', [ReviewController::class, 'store']);
    Route::put('/trips/{trip}reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/trips/{trip}/reviews/{review}', [ReviewController::class, 'destroy']);
});

