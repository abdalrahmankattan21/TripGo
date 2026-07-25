<?php

namespace App\Services;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Collection;

class DestinationService
{
    public function getAllDestinations(): Collection
    {
        return Destination::all();
    }
}
