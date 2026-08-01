<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDestinationController;
use App\Http\Controllers\Admin\AdminGuideController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminTripController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')
    ->middleware('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('destinations', AdminDestinationController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('trips', AdminTripController::class);
        Route::resource('bookings', AdminBookingController::class);
        Route::resource('guides', AdminGuideController::class);

        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('pilgrims-revenue', [AdminReportController::class, 'pilgrimsRevenue'])->name('pilgrims-revenue');
            Route::get('popular-destinations', [AdminReportController::class, 'popularDestinations'])->name('popular-destinations');
            Route::get('occupancy-rate', [AdminReportController::class, 'occupancyRate'])->name('occupancy-rate');
            Route::get('monthly-revenue', [AdminReportController::class, 'monthlyRevenue'])->name('monthly-revenue');
            Route::get('cancellations', [AdminReportController::class, 'cancellations'])->name('cancellations');
        });
    });
