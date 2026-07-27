<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Services\TripService;
use App\Traits\ApiResponseTrait;

class TripController extends Controller
{
    private  TripService $tripService;
    use ApiResponseTrait;

    public function __construct(TripService $tripService) {
        $this->tripService =  $tripService;
    }

    public function index()
    {
        return $this->success(
            'Available trips retrieved successfully.',
            $this->tripService->getAvailableTrips()
        );
    }

    public function show(Trip $trip)
    {
        return $this->success(
            'Trip details retrieved successfully.',
            $this->tripService->getTripDetails($trip)
        );
    }
}
