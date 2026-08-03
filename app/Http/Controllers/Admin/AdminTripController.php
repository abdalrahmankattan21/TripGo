<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Category;
use App\Models\Guide;
use App\Services\Admin\AdminTripService;
use App\Services\Admin\AdminDestinationService;
use App\Services\Admin\AdminCategoryService;
use Illuminate\Http\Request;

class AdminTripController extends Controller
{
    protected $adminTripService;
    protected $adminDestinationService;
    protected $adminCategoryService;

    public function __construct(AdminTripService $adminTripService, AdminDestinationService $adminDestinationService, AdminCategoryService $adminCategoryService)
    {
        $this->adminTripService = $adminTripService;
        $this->adminDestinationService = $adminDestinationService;
        $this->adminCategoryService = $adminCategoryService;
    }

    public function index(Request $request)
    {

        // dd($request->all());
        $filters = $request->only(['trip_id', 'status', 'date_from', 'date_to', 'destination_id', 'category_id']);
        return view('admin.trips.index', [
            'trips' => $this->adminTripService->getAllTrips($filters),
            'destinations' =>$this->adminDestinationService->list($filters['destination_id'] ?? null),
            'categories' => $this->adminCategoryService->list($filters['category_id'] ?? null),
            'filters' => $filters,
        ]);
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
            'total_seats' => 'required|integer|min:1',
            'departure_point' => 'required|string|max:255',
            'price' => 'required|decimal:2|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:scheduled,in-progress,completed',
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
            'total_seats' => 'required|integer|min:1',
            'departure_point' => 'required|string|max:255',
            'price' => 'required|decimal:2|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:scheduled,in-progress,completed',
            'guides' => 'array|exists:guides,id',
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
