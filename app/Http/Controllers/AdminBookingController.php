<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    protected BookingService $bookingService;

    /**
     * حقن خدمة الحجوزات في الكونترولر (Dependency Injection)
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * 1. عرض قائمة الحجوزات مع إمكانية الفلترة (Filters)
     */
    public function index(Request $request)
    {
        // استقبال الفلاتر من الطلب (حسب المطلوب: status, trip_id, user_id, booking_date, start_date)
        $filters = $request->only(['status', 'trip_id', 'user_id', 'booking_date', 'start_date']);

        // استدعاء الخدمة لجلب البيانات المفلترة
        $bookings = $this->bookingService->getFilteredBookings($filters);

        // إرجاع النتيجة كـ JSON (أو View إذا أردت لاحقاً)
        return response()->json($bookings);
    }

    /**
     * 2. عرض تفاصيل حجز معين (Show)
     */
    public function show($id)
    {
        $booking = $this->bookingService->getBookingById($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }

    /**
     * 3. إنشاء حجز جديد (Store)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'trip_id' => 'required|exists:trips,id',
            'number_of_seats' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'guest_names' => 'required|array',
            'status' => 'in:pending,confirmed,cancelled',
        ]);

        $booking = $this->bookingService->createBooking($validated);

        return response()->json($booking, 201);
    }

    /**
     * 4. تعديل بيانات حجز (Update)
     */
    public function update(Request $request, $id)
    {
        $booking = $this->bookingService->getBookingById($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $validated = $request->validate([
            'number_of_seats' => 'integer|min:1',
            'total_price' => 'numeric',
            'guest_names' => 'array',
            'status' => 'in:pending,confirmed,cancelled',
        ]);

        $this->bookingService->updateBooking($booking, $validated);

        return response()->json(['message' => 'Booking updated successfully']);
    }

    /**
     * 5. حذف حجز (Destroy)
     */
    public function destroy($id)
    {
        $booking = $this->bookingService->getBookingById($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $this->bookingService->deleteBooking($booking);

        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
