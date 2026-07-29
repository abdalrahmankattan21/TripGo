<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminBookingService;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    protected AdminBookingService $service;

    public function __construct(AdminBookingService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $bookings = $this->service->getFilteredBookings($request);
        $filterData = $this->service->getFilterData();

        return view('admin.bookings.index', array_merge(['bookings' => $bookings], $filterData));
    }

    public function show($id)
    {
        $booking = $this->service->getBookingById($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function create()
    {
        return view('admin.bookings.create');
    }

    public function store(Request $request)
    {
        // هنا سنضيف التحقق (Validation) لاحقاً
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'trip_id' => 'required|exists:trips,id',
            'number_of_seats' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'guest_names' => 'required|array',
            'status' => 'in:pending,confirmed,cancelled',
        ]);

        $this->service->createBooking($data);

        return redirect()->route('admin.bookings.index')->with('success', 'تم إنشاء الحجز بنجاح');
    }

    public function edit($id)
    {
        $booking = $this->service->getBookingById($id);
        return view('admin.bookings.edit', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $booking = $this->service->getBookingById($id);

        $data = $request->validate([
            'number_of_seats' => 'integer|min:1',
            'total_price' => 'numeric',
            'guest_names' => 'array',
            'status' => 'in:pending,confirmed,cancelled',
        ]);

        $this->service->updateBooking($booking, $data);

        return redirect()->route('admin.bookings.index')->with('success', 'تم تحديث الحجز بنجاح');
    }

    public function destroy($id)
    {
        $booking = $this->service->getBookingById($id);
        $this->service->deleteBooking($booking);

        return redirect()->route('admin.bookings.index')->with('success', 'تم حذف الحجز بنجاح');
    }
}
