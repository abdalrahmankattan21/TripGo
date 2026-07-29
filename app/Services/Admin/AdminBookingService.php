<?php

namespace App\Services\Admin;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminBookingService
{
    // جلب الحجوزات مع الفلاتر
    public function getFilteredBookings(Request $request)
    {
        $query = Booking::with(['user', 'trip']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('trip_id')) {
            $query->where('trip_id', $request->trip_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('booking_date')) {
            $query->whereDate('booking_date', $request->booking_date);
        }

        if ($request->filled('start_date')) {
            $query->whereHas('trip', function (Builder $q) use ($request) {
                $q->whereDate('start_date', $request->start_date);
            });
        }

        return $query->latest()->paginate(10); // نستخدم paginate بدلاً من get لتقسيم الصفحات
    }

    // جلب بيانات الرحلات والمستخدمين لملء قوائم الفلاتر
    public function getFilterData()
    {
        $trips = Trip::all(['id', 'title']);
        $users = User::all(['id', 'name']);
        return compact('trips', 'users');
    }

    public function getBookingById($id)
    {
        return Booking::with(['user', 'trip'])->findOrFail($id);
    }

    public function createBooking(array $data)
    {
        return Booking::create($data);
    }

    public function updateBooking(Booking $booking, array $data)
    {
        return $booking->update($data);
    }

    public function deleteBooking(Booking $booking)
    {
        return $booking->delete();
    }
}
