<?php
namespace App\Services\Admin;

use App\Models\Trip;
use Carbon\Carbon;

class AdminTripService
{
    // 1. جلب كافة الرحلات مع المرشدين
    public function getAllTrips($perPage = 10)
    {
        return Trip::latest()->paginate($perPage);
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
            'destination' => $data['destination'],
            'start_date'  => Carbon::parse($data['start_date']),
            'end_date'    => Carbon::parse($data['end_date']),
        ]);
    }

    // 4. تحديث بيانات رحلة موجودة
    public function updateTrip($id, array $data)
    {
        $trip = Trip::findOrFail($id);
        $trip->update([
            'destination' => $data['destination'],
            'start_date'  => Carbon::parse($data['start_date']),
            'end_date'    => Carbon::parse($data['end_date']),
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
