<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminDashboardService;
use App\Services\Admin\AdminReportService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    protected AdminDashboardService $service;
    protected AdminReportService $reportService;

    public function __construct(
        AdminDashboardService $service,
        AdminReportService $reportService
    ) {
        $this->service = $service;
        $this->reportService = $reportService;
    }

    public function index()
    {
        $statistics = $this->service->getSummaryStatistics();

        $topDestinations = $this->reportService->mostPopularDestinations([]);

        return view('admin.dashboard.index', compact('statistics', 'topDestinations'));
    }
}
