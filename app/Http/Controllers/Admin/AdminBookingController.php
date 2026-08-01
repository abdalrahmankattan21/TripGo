<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trip;
use App\Services\Admin\AdminBookingService;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    protected AdminBookingService $bookingService;

    public function __construct(AdminBookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
       $filters = $request->only(['trip_id', 'status', 'date_from', 'date_to']);

        return view('admin.bookings.index', [
            'bookings' => $this->bookingService->list($filters),
            'trips' => Trip::orderBy('title')->get(['id', 'title']),
            'filters' => $filters,
        ]);
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', [
            'booking' => $this->bookingService->findWithDetails($booking),
        ]);
    }

}
