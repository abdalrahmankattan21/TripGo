<?php

namespace App\Services\Admin;

use App\Models\Trip;
use App\Models\Booking;
use App\Models\User;
use App\Models\Payment;


class AdminDashboardService
{
    public function getSummaryStatistics(): array
    {
        return [
            'total_trips' => Trip::count(),
            'total_bookings' => Booking::where('status', '!=', 'cancelled')->count(),
            'total_users' => User::count(),
            'total_revenue' => (float) Payment::sum('amount'),

            // Trip status
            'scheduled_trips' => Trip::where('status', 'scheduled')->count(),
            'in_progress_trips' => Trip::where('status', 'in-progress')->count(),
            'completed_trips' => Trip::where('status', 'completed')->count(),
        ];
    }
}
