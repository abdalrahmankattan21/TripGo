<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    public function getFilteredBookings(array $filters): Collection
    {
        return Booking::with(['user', 'trip'])
            ->when(!empty($filters['status']), function (Builder $query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(!empty($filters['trip_id']), function (Builder $query) use ($filters) {
                $query->where('trip_id', $filters['trip_id']);
            })
            ->when(!empty($filters['user_id']), function (Builder $query) use ($filters) {
                $query->where('user_id', $filters['user_id']);
            })
            ->when(!empty($filters['booking_date']), function (Builder $query) use ($filters) {
                $query->whereDate('booking_date', $filters['booking_date']);
            })
            ->when(!empty($filters['start_date']), function (Builder $query) use ($filters) {

            $query->whereHas('trip', function (Builder $q) use ($filters) {
                    $q->whereDate('start_date', $filters['start_date']);
                });
            })
            ->latest()
            ->get();
    }

    public function getBookingById(int $id): ?Booking
    {
        return Booking::with(['user', 'trip'])->find($id);
    }

    public function createBooking(array $data): Booking
    {
        return Booking::create($data);
    }

    public function updateBooking(Booking $booking, array $data): bool
    {
        return $booking->update($data);
    }

    public function deleteBooking(Booking $booking): bool
    {
        return $booking->delete();
    }
}
