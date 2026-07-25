<?php

namespace App\Services;

use App\Models\Trip;

class TripService
{
    public function getAvailableTrips()
    {
        return Trip::
            with(['destination', 'category'])
            ->where('status', 'scheduled')
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->paginate(15);
    }

    public function getTripDetails(Trip $trip): Trip
    {
        return $trip->load(['destination', 'category']);
    }
}
