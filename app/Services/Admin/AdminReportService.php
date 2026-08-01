<?php

namespace App\Services\Admin;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Payment;
use App\Models\Trip;

class AdminReportService
{
    public function pilgrimsAndRevenuePerFlight(array $filters = [])
    {
        return Trip::with(['destination', 'category'])
            ->when(!empty($filters['destination_id']), fn ($q) => $q->where('destination_id', $filters['destination_id']))
            ->when(!empty($filters['category_id']), fn ($q) => $q->where('category_id', $filters['category_id']))
            ->when(!empty($filters['date_from']), fn ($q) => $q->whereDate('start_date', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']), fn ($q) => $q->whereDate('start_date', '<=', $filters['date_to']))
            ->withCount(['bookings' => fn ($q) => $q->where('status', '!=', 'cancelled')])
            ->withSum(['bookings as pilgrims_count' => fn ($q) => $q->where('status', '!=', 'cancelled')], 'seats')
            ->withSum(['bookings as revenue' => fn ($q) => $q->where('status', '!=', 'cancelled')], 'total_price')
            ->orderByDesc('revenue')
            ->get()
            ->map(fn (Trip $trip) => [
                'flight_name' => $trip->title,
                'destination' => $trip->destination->name ?? '—',
                'bookings_count' => $trip->bookings_count,
                'pilgrims_count' => (int) ($trip->pilgrims_count ?? 0),
                'revenue' => (float) ($trip->revenue ?? 0),
            ]);
    }

    public function mostPopularDestinations(array $filters = [])
    {
        return Destination::withSum(['trips as pilgrims_count' => function ($query) use ($filters) {
                $query->join('bookings', 'bookings.trip_id', '=', 'trips.id')
                    ->where('bookings.status', '!=', 'cancelled')
                    ->when(!empty($filters['category_id']), fn ($q) => $q->where('trips.category_id', $filters['category_id']))
                    ->when(!empty($filters['date_from']), fn ($q) => $q->whereDate('bookings.booked_at', '>=', $filters['date_from']))
                    ->when(!empty($filters['date_to']), fn ($q) => $q->whereDate('bookings.booked_at', '<=', $filters['date_to']));
            }], 'bookings.seats')
            ->orderByDesc('pilgrims_count')
            ->get(['id', 'name'])
            ->map(fn (Destination $destination) => [
                'destination_name' => $destination->name,
                'pilgrims_count' => (int) ($destination->pilgrims_count ?? 0),
            ]);
    }

    public function occupancyRate(array $filters = [])
    {
        return Trip::when(!empty($filters['destination_id']), fn ($q) => $q->where('destination_id', $filters['destination_id']))
            ->when(!empty($filters['category_id']), fn ($q) => $q->where('category_id', $filters['category_id']))
            ->get(['id', 'title', 'total_seats', 'available_seats'])
            ->map(function (Trip $trip) {
                $bookedSeats = $trip->total_seats - $trip->available_seats;
                $occupancyRate = $trip->total_seats > 0
                    ? round(($bookedSeats / $trip->total_seats) * 100, 2)
                    : 0.0;

                return [
                    'flight_name' => $trip->title,
                    'booked_seats' => $bookedSeats,
                    'total_seats' => $trip->total_seats,
                    'occupancy_rate' => $occupancyRate,
                ];
            })
            ->sortByDesc('occupancy_rate')
            ->values();
    }

    public function monthlyRevenue(array $filters = [])
    {
        return Payment::where('status', 'paid')
            ->when(!empty($filters['date_from']), fn ($q) => $q->whereDate('created_at', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']), fn ($q) => $q->whereDate('created_at', '<=', $filters['date_to']))
            ->get(['amount', 'created_at'])
            ->groupBy(fn (Payment $payment) => $payment->created_at->format('Y-m'))
            ->map(fn ($payments, string $month) => [
                'month' => $month,
                'revenue' => (float) $payments->sum('amount'),
            ])
            ->sortBy('month')
            ->values();
    }

    public function cancellations(array $filters = [])
    {
        return Booking::with(['user:id,name,email', 'trip:id,title'])
            ->where('status', 'cancelled')
            ->when(!empty($filters['trip_id']), fn ($q) => $q->where('trip_id', $filters['trip_id']))
            ->when(!empty($filters['date_from']), fn ($q) => $q->whereDate('created_at', '>=', $filters['date_from']))
            ->when(!empty($filters['date_to']), fn ($q) => $q->whereDate('created_at', '<=', $filters['date_to']))
            ->latest('created_at')
            ->get()
            ->map(fn (Booking $booking) => [
                'booking_id' => $booking->id,
                'user_name' => $booking->user->name ?? 'N/A',
                'flight_name' => $booking->trip->title ?? 'N/A',
                'cancelled_at' => $booking->created_at,
                'reason' => $booking->cancellation_reason ?? null,
            ]);
    }
}
