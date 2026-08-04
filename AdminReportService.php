<?php

namespace App\Services\Admin;

use App\Models\Destination;

class AdminReportService
{

   public function mostPopularDestinations($filters = [])
{
    $query = Destination::select('destinations.id', 'destinations.name')
        ->join('trips', 'trips.destination_id', '=', 'destinations.id')
        ->join('bookings', 'bookings.trip_id', '=', 'trips.id')
        ->selectRaw('COUNT(bookings.id) as total_bookings')
        ->groupBy('destinations.id', 'destinations.name')
        ->orderByDesc('total_bookings');


    return $query->limit(5)->get();
}
}
