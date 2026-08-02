<?php

namespace App\Services\Admin;

use App\Models\Trip;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminTripService
{
    public function list(array $filters = [])
    {
        return Trip::with(['destination', 'category'])
            ->when(!empty($filters['destination_id']), fn ($query) => $query->where('destination_id', $filters['destination_id']))
            ->when(!empty($filters['category_id']), fn ($query) => $query->where('category_id', $filters['category_id']))
            ->when(!empty($filters['status']), fn ($query) => $query->where('status', $filters['status']))
            ->when(!empty($filters['start_date']), fn ($query) => $query->whereDate('start_date', $filters['start_date']))
            ->latest()
            ->paginate(15);
    }

    public function create(array $data, $image)
    {
        if ($image !== null) {
            $data['image'] = $this->storeImage($image);
        }

        $data['available_seats'] = $data['total_seats'];

        return Trip::create($data);
    }

    public function update(Trip $trip, array $data, $image)
    {
        if ($image !== null) {
            $this->deleteImage($trip);
            $data['image'] = $this->storeImage($image);
        }

        if (isset($data['total_seats']) && $data['total_seats'] != $trip->total_seats) {

        $bookedSeats = $trip->total_seats - $trip->available_seats;

        if ($data['total_seats'] < $bookedSeats) {
            throw ValidationException::withMessages([
            'total_seats' => "You cannot reduce the number of seats to {$data['total_seats']} because there are {$bookedSeats} booked seats."]);
        }


        $data['available_seats'] = $data['total_seats'] - $bookedSeats;
        }

        $trip->update($data);

        return $trip->fresh();

    }

    public function delete(Trip $trip)
    {
        $this->deleteImage($trip);
        $trip->delete();
    }

    private function storeImage($image)
    {
        return $image->store('trips', 'public');
    }

    private function deleteImage(Trip $trip)
    {
        if ($trip->image) {
            Storage::disk('public')->delete($trip->image);
        }
    }
}
