<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Destination;
use App\Models\Trip;
use App\Services\Admin\AdminReportService;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    private AdminReportService $reportService;
    public function __construct(AdminReportService $reportService) {
        $this->reportService = $reportService;
    }

    public function pilgrimsRevenue(Request $request)
    {
        $filters = $request->only(['destination_id', 'category_id', 'date_from', 'date_to']);

        return view('admin.reports.pilgrims-revenue', array_merge([
            'rows' => $this->reportService->pilgrimsAndRevenuePerFlight($filters),
            'filters' => $filters,
        ], $this->tripFilterOptions()));
    }

    public function popularDestinations(Request $request)
    {
        $filters = $request->only(['category_id', 'date_from', 'date_to']);

        return view('admin.reports.popular-destinations', [
            'rows' => $this->reportService->mostPopularDestinations($filters),
            'filters' => $filters,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function occupancyRate(Request $request)
    {
        $filters = $request->only(['destination_id', 'category_id', 'status']);

        return view('admin.reports.occupancy-rate', array_merge([
            'rows' => $this->reportService->occupancyRate($filters),
            'filters' => $filters,
        ], $this->tripFilterOptions()));
    }

    public function monthlyRevenue(Request $request)
    {
        $filters = $request->only(['date_from', 'date_to']);

        return view('admin.reports.monthly-revenue', [
            'rows' => $this->reportService->monthlyRevenue($filters),
            'filters' => $filters,
        ]);
    }

    public function cancellations(Request $request)
    {
        $filters = $request->only(['trip_id', 'date_from', 'date_to']);

        return view('admin.reports.cancellations', [
            'rows' => $this->reportService->cancellations($filters),
            'filters' => $filters,
            'trips' => Trip::orderBy('title')->get(['id', 'title']),
        ]);
    }

    private function tripFilterOptions(): array
    {
        return [
            'destinations' => Destination::orderBy('name')->get(),
            'categories' => Category::orderBy('name')->get(),
        ];
    }

}
