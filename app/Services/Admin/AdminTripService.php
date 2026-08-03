<?php
namespace App\Services\Admin;

use App\Models\Trip;
use Carbon\Carbon;

class AdminTripService
{
    // 1. جلب كافة الرحلات مع المرشدين
    public function getAllTrips($filters)
    {
        $query = Trip::latest();

        if (!empty($filters['trip_id'])) {
            $query->where('id', $filters['trip_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['date_from'])) {
            $query->where('start_date', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->where('start_date', '<=', $filters['date_to']);
        }

        if (!empty($filters['destination_id'])) {
            $query->where('destination_id', $filters['destination_id']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        return $query->paginate($filters['per_page'] ?? 10);
    }

    // 2. جلب تفاصيل رحلة واحدة محددة
    public function getTripById($id)
    {
        return Trip::with('guides')->findOrFail($id);
    }

    // 3. إنشاء رحلة جديدة
    public function createTrip(array $data)
    {

        return Trip::create([
            'title'=>$data['title'],
            'destination_id' => $data['destination_id'],
            'start_date'  => Carbon::parse($data['start_date']),
            'end_date'    => Carbon::parse($data['end_date']),
            'booking_cancel_deadline' => Carbon::parse($data['start_date'])->subDays(2),
            'total_seats' => $data['total_seats'],
            'available_seats' => $data['total_seats'],
            'departure_point' => $data['departure_point'],
            'price' => $data['price'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'status' => $data['status'],
        ]);
    }

    // 4. تحديث بيانات رحلة موجودة
    public function updateTrip($id, array $data)
    {
        $trip = Trip::findOrFail($id);
        $trip->update([
            'title' => $data['title'],
            'destination_id' => $data['destination_id'],
            'start_date'  => Carbon::parse($data['start_date']),
            'end_date'    => Carbon::parse($data['end_date']),
            'booking_cancel_deadline' => Carbon::parse($data['start_date'])->subDays(2),
            'total_seats' => $data['total_seats'],
            'available_seats' => $data['total_seats'],
            'departure_point' => $data['departure_point'],
            'price' => $data['price'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'status' => $data['status'],
        ]);
        return $trip;
    }

    // 5. حذف رحلة من النظام
    public function deleteTrip($id)
    {
        $trip = Trip::findOrFail($id);
        return $trip->delete();
    }
}
