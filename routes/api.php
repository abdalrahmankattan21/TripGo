<?php

<<<<<<< HEAD
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\WaitingListController;
use Illuminate\Support\Facades\Route;

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
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
>>>>>>> main
