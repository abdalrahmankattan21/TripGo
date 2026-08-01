<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\trips\StoreTripRequest;
use App\Http\Requests\trips\UpdateTripRequest;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Trip;
use App\Services\Admin\AdminTripService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminTripController extends Controller
{
    private  AdminTripService $tripService;
    public function __construct(AdminTripService $tripService) {
        $this->tripService = $tripService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['destination_id', 'category_id', 'status', 'start_date']);

        return view('admin.trips.index', array_merge([
            'trips' => $this->tripService->list($filters),
            'filters' => $filters,
        ], $this->formOptions()));
    }

    public function create()
    {
        return view('admin.trips.create', $this->formOptions());
    }

    public function store(StoreTripRequest $request)
    {
        $data = $request->validated();
        $this->tripService->create($data, $request->file('image'));

        return redirect()
            ->route('admin.trips.index')
            ->with('success', 'Trip created successfully.');
    }

    public function show(Trip $trip)
    {
        return view('admin.trips.show', [
            'trip' => $trip->load(['destination', 'category']),
        ]);
    }

    public function edit(Trip $trip)
    {
        return view('admin.trips.edit', array_merge(['trip' => $trip], $this->formOptions()));
    }

    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $data = $request->validated();
        $this->tripService->update($trip, $data, $request->file('image'));

        return redirect()
            ->route('admin.trips.index')
            ->with('success', 'Trip updated successfully.');
    }

    public function destroy(Trip $trip): RedirectResponse
    {
        $this->tripService->delete($trip);

        return redirect()
            ->route('admin.trips.index')
            ->with('success', 'Trip deleted successfully.');
    }
    private function formOptions()
    {
        return [
            'destinations' => Destination::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ];
    }
}
