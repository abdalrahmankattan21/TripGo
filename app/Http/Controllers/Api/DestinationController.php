<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Services\DestinationService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    private DestinationService $destinationService;
     use ApiResponseTrait;

    public function __construct(DestinationService $destinationService) {
        $this->destinationService = $destinationService;
    }
    public function index()
    {
        return $this->success(
            'Destinations retrieved successfully.',
            $this->destinationService->getAllDestinations()
        );
    }

    public function show(Destination $destination)
    {
        return $this->success(
            'Destination details retrieved successfully.',
            $destination
        );
    }
}
