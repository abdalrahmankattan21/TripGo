<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\BookingException;
use App\Http\Controllers\Controller;
use App\Http\Requests\bookings\CancelBookingRequest;
use App\Http\Requests\bookings\StoreBookingRequest;
use App\Services\BookingService;
use App\Models\Booking;
use App\Models\Trip;
use App\Traits\ApiResponseTrait;

class BookingController extends Controller
{
    use ApiResponseTrait;
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success('Bookings retrieved successfully.', $this->bookingService->getUserBookings(auth()->id())
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Trip $trip, StoreBookingRequest $request)
    {
        $data =  $request->validated();

        try {
            $result = $this->bookingService->bookTrip($trip, auth()->id(), $data['companions']
            );
        } catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }

        if ($result['type'] === 'booking') {
            return $this->success(
                'Booking created successfully.',
                [
                    'type' => 'booking',
                    'booking' => $result['data'],
                ], 201);
        }

        return $this->success(
            'The trip is fully booked. You have been added to the waiting list.',
            [
                'type' => 'waiting_list',
                'waiting_list' => $result['data'],
            ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        try {
            $booking = $this->bookingService->getUserBooking($booking, auth()->id());
        } catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }

        return $this->success('Booking details retrieved successfully.', $booking);
    }

    // cancel booking
    public function cancel(Booking $booking, CancelBookingRequest $request)
    {
        $data =  $request->validated();
        
        try {
            $result = $this->bookingService->cancelBooking($booking, auth()->id(), $data);
        } catch (BookingException $exception) {
            return $this->error($exception->getMessage(), $exception->getStatusCode());
        }

        $message = 'Booking cancelled successfully.';

        if ($result['promotion'] !== null) {
            $message .= ' A user from the waiting list has been promoted to a confirmed booking.';
        }

        return $this->success($message, [
            'booking' => $result['booking'],
            'promoted_booking' => $result['promotion'],
        ]);
    }
}
