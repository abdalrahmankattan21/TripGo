<?php

namespace App\Services\Admin;

use App\Models\Booking;

class AdminBookingService
{
    public function list(array $filters = [])
    {
        return Booking::with(['user', 'trip', 'companions', 'payment'])
            ->when(!empty($filters['trip_id']), fn ($q) => $q->where('trip_id', $filters['trip_id']))
            ->when(!empty($filters['status']), fn ($q) => $q->where('status', $filters['status']))
            ->when(!empty($filters['date_from']), fn ($q) => $q->whereDate('booked_at', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']), fn ($q) => $q->whereDate('booked_at', '<=', $filters['date_to']))
            ->latest('booked_at')
            ->paginate(15);
    }

   public function findWithDetails(Booking $booking)
    {
        return $booking->load(['user', 'trip', 'companions', 'payment']);
    }
}
