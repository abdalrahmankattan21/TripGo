<?php

namespace App\Services;

use App\Exceptions\BookingException;
use App\Models\Booking;
use App\Models\Companion;
use App\Models\Payment;
use App\Models\Trip;
use App\Models\WaitingList;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function bookTrip(Trip $trip, int $userId, array $companions)
    {
        return DB::transaction(function () use ($trip, $userId, $companions) {

            $this->isTripScheduled($trip);
            $this->DoesUserHasBooking($trip->id, $userId);
            $this->isUserAlreadyInWaitingList($trip->id, $userId);

            // The user is 1 seat plus the number of companions
            $seats = count($companions) + 1;
            $totalPrice = $trip->price * $seats;

            if ($trip->available_seats >= $seats) {
                return [
                    'type' => 'booking',
                    'data' => $this->createConfirmedBooking($trip, $userId, $seats, $totalPrice, $companions),
                ];
            }

            return [
                'type' => 'waiting_list',
                'data' => $this->addToWaitingList($trip, $userId, $seats, $companions),
            ];
        });
    }

    public function cancelBooking(Booking $booking, int $userId, array $data)
    {
        $result = DB::transaction(function () use ($booking, $userId, $data) {

            $this->checkIfBookingBelongsToUser($booking, $userId);
            $this->checkIfBookingNotAlreadyCancelled($booking);

            $trip = Trip::where('id', $booking->trip_id)->first();

            $this->checkIfBeforeCancelDeadline($trip);

            $booking->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
                'cancellation_reason' => $data['cancellation_reason']
            ]);

            $trip->increment('available_seats', $booking->seats);
            $trip->refresh();

            $promotedBooking = $this->promoteNextWaitingUser($trip, $booking->seats);

            return [
                'booking' => $booking->fresh(),
                'promotion' => $promotedBooking,
            ];
        });

        if ($result['promotion'] !== null) {
            $this->notifyPromotedUser($result['promotion']);
        }

        return $result;
    }

    public function getUserBookings(int $userId)
    {
        return Booking::with(['trip', 'companions'])
            ->where('user_id', $userId)
            ->latest('booked_at')
            ->paginate(15);
    }

    public function getUserBooking(Booking $booking, int $userId)
    {
        $this->checkIfBookingBelongsToUser($booking, $userId);
        return $booking->load(['trip', 'companions']);
    }
    private function notifyPromotedUser(Booking $promotedBooking)
    {
        $promotedBooking->loadMissing(['user', 'trip']);

        // TODO: send email
    }


    private function isTripScheduled(Trip $trip)
    {
        if ($trip->status !== 'scheduled') {
            throw new BookingException('This trip is not open for booking.', 422);
        }
    }

    private function DoesUserHasBooking(int $tripId, int $userId)
    {
        $alreadyBooked = Booking::where('trip_id', $tripId)
            ->where('user_id', $userId)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($alreadyBooked) {
            throw new BookingException('You already have a booking for this trip.', 422);
        }
    }

    private function isUserAlreadyInWaitingList(int $tripId, int $userId)
    {
        $alreadyWaiting = WaitingList::where('trip_id', $tripId)
            ->where('user_id', $userId)
            ->where('status', 'waiting')
            ->exists();

        if ($alreadyWaiting) {
            throw new BookingException('You are already on the waiting list for this trip.', 422);
        }
    }

    private function checkIfBookingBelongsToUser(Booking $booking, int $userId)
    {
        if ($booking->user_id !== $userId) {
            throw new BookingException('This booking does not belong to you.', 403);
        }
    }

    private function checkIfBookingNotAlreadyCancelled(Booking $booking)
    {
        if ($booking->status === 'cancelled') {
            throw new BookingException('This booking has already been cancelled.', 422);
        }
    }

    private function checkIfBeforeCancelDeadline(Trip $trip)
    {
        if ($trip->booking_cancel_deadline !== null && now()->greaterThan($trip->booking_cancel_deadline)) {
            throw new BookingException('The cancellation deadline for this trip has passed.', 422);
        }
    }

    private function createConfirmedBooking(Trip $trip, int $userId, int $seats, float $totalPrice, array $companions) {
        $booking = Booking::create([
            'user_id' => $userId,
            'trip_id' => $trip->id,
            'seats' => $seats,
            'total_price' => $totalPrice,
            'status' => 'confirmed',
            'booked_at' => now(),
        ]);
        if(count($companions) > 0) {
            $this->createCompanions($companions, $booking->id);
        }

        $trip->decrement('available_seats', $seats);

        Payment::create([
            "amount" => $totalPrice,
            "booking_id" => $booking->id,
        ]);

        return $booking->fresh('companions');
    }

    private function addToWaitingList(Trip $trip, int $userId, int $seats, array $companions)
    {
        $lastPosition = WaitingList::where('trip_id', $trip->id)->max('position') ?? 0;

        $waitingList = WaitingList::create([
            'user_id' => $userId,
            'trip_id' => $trip->id,
            'seats' => $seats,
            'position' => $lastPosition + 1,
            'status' => 'waiting',
        ]);
        if(count($companions) > 0) {
            $this->createCompanions($companions, null, $waitingList->id);
        }

        return $waitingList->fresh('companions');
    }

    private function createCompanions(array $companions, $bookingId = null, $waitingListId = null)
    {
        foreach ($companions as $companion) {
            Companion::create([
                'name' => $companion['name'],
                'national_id' => $companion['national_id'] ?? null,
                'booking_id' => $bookingId,
                'waiting_list_id' => $waitingListId,
            ]);
        }
    }

    private function promoteNextWaitingUser(Trip $trip, int $seats)
    {
        $nextInLine = WaitingList::where('trip_id', $trip->id)
            ->where('status', 'waiting')
            ->where('seats_requested', $seats)
            ->orderBy('position')
            ->first();

        if ($nextInLine === null) {
            return null;
        }

        if ($trip->available_seats < $nextInLine->seats) {

            return null;
        }

        $totalPrice = $trip->price * $nextInLine->seats;

        $booking = Booking::create([
            'user_id' => $nextInLine->user_id,
            'trip_id' => $trip->id,
            'seats' => $nextInLine->seats_requested,
            'total_price' => $totalPrice,
            'status' => 'pending_payment',
            'booked_at' => now(),
        ]);

        Companion::where('waiting_list_id', $nextInLine->id)->update([
            'waiting_list_id' => null,
            'booking_id' => $booking->id,
        ]);

        $nextInLine->update(['status' => 'confirmed']);

        $trip->decrement('available_seats', $nextInLine->seats_requested);

        return $booking->fresh('companions');
    }
}
