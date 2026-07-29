<?php

namespace App\Services\Admin;

use App\Models\Guide;
use Illuminate\Http\Request;

class AdminGuideService
{
    // جلب المرشدين مع الفلاتر والبحث
    public function getFilteredGuides(Request $request)
    {
        $query = Guide::query();

        // فلترة حسب الحالة (status)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // البحث حسب الاسم
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // البحث حسب البريد الإلكتروني
        if ($request->filled('email')) {
            $query->where('email', 'LIKE', '%' . $request->email . '%');
        }

        // البحث حسب رقم الهاتف
        if ($request->filled('phone')) {
            $query->where('phone', 'LIKE', '%' . $request->phone . '%');
        }

        return $query->latest()->paginate(10);
    }

    public function getGuideById($id)
    {
        return Guide::findOrFail($id);
    }

    public function createGuide(array $data)
    {
        return Guide::create($data);
    }

    public function updateGuide(Guide $guide, array $data)
    {
        return $guide->update($data);
    }

    public function deleteGuide(Guide $guide)
    {
        return $guide->delete();
    }
}
