<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Category;
use App\Models\Guide;
use App\Services\Admin\AdminTripService;
use Illuminate\Http\Request;

class AdminTripController extends Controller
{
    protected $adminTripService;

    public function __construct(AdminTripService $adminTripService)
    {
        $this->adminTripService = $adminTripService;
    }

    public function index()
    {
        $trips = $this->adminTripService->getAllTrips(10);
        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        $trip = null;
        $destinations = Destination::all();
        $categories = Category::all();
        $guides = Guide::all();
        return view('admin.trips.create', compact('trip', 'destinations', 'categories', 'guides'));
    }

    // حفظ الرحلة الجديدة في قاعدة البيانات
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'start_date'  => 'required|date|after_or_equal:today',
            'end_date'    => 'required|date|after:start_date',
            'guides' => 'array|exists:guides,id',
        ]);

        $this->adminTripService->createTrip($validatedData);

        return redirect('/admin/trips')->with('success', 'تم إنشاء الرحلة السياحية بنجاح.');
    }

    public function show($id)
    {
        $trip = $this->adminTripService->getTripById($id);
        return view('admin.trips.show', compact('trip'));
    }
    public function edit($id)
    {
        $trip = $this->adminTripService->getTripById($id);
        $destinations = Destination::all();
        $categories = Category::all();
        $guides = Guide::all();
        return view('admin.trips.edit', compact('trip','destinations', 'categories', 'guides'));
    }

    // تحديث بيانات الرحلة المعدلة
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'start_date'  => 'required|date|after_or_equal:today',
            'end_date'    => 'required|date|after:start_date',
            'slug' => 'required|string|max:255|unique:trips,slug',
        ]);

        $this->adminTripService->updateTrip($id, $validatedData);

        return redirect('/admin/trips')->with('success', 'تم تحديث بيانات الرحلة بنجاح.');
    }

    // حذف رحلة نهائياً
    public function destroy($id)
    {
        $this->adminTripService->deleteTrip($id);
        return redirect()->back()->with('success', 'تم حذف الرحلة بنجاح.');
    }
}
