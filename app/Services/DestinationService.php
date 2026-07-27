<?php

namespace App\Services;

use App\Models\Destination;

class DestinationService
{
    public function getAllDestinations()
    {
        return Destination::all();
    }
}
