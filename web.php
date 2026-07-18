<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AdminBookingController;

Route::prefix('admin')->group(function () {
    Route::resource('bookings', AdminBookingController::class);
});
