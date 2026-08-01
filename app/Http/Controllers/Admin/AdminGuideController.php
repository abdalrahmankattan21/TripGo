<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GuideRequest;
use App\Http\Requests\guides\StoreGuideRequest;
use App\Http\Requests\guides\UpdateGuideRequest;
use App\Models\Guide;
use App\Models\Trip;
use App\Services\Admin\AdminGuideService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminGuideController extends Controller
{
    private AdminGuideService $guideService;
    public function __construct(AdminGuideService $guideService) {
        $this->guideService = $guideService;
    }

    public function index(Request $request)
    {
        return view('admin.guides.index', [
            'guides' => $this->guideService->list($request->input('search') ? : null)
        ]);
    }

    public function create()
    {
        return view('admin.guides.create', [
            'trips' => Trip::orderBy('title')->get(['id', 'title']),
        ]);
    }

    public function store(StoreGuideRequest $request)
    {
        $data = $request->validated();
        $this->guideService->create($data);

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Guide created successfully.');
    }

    public function show(Guide $guide)
    {
        return view('admin.guides.show', [
            'guide' => $guide->load('trips'),
        ]);
    }

    public function edit(Guide $guide)
    {
        return view('admin.guides.edit', [
            'guide' => $guide,
            'trips' => Trip::orderBy('title')->get(['id', 'title']),
        ]);
    }

    public function update(UpdateGuideRequest $request, Guide $guide): RedirectResponse
    {
        $data = $request->validated();

        $this->guideService->update($guide, $data);

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Guide updated successfully.');
    }

    public function destroy(Guide $guide)
    {
        $this->guideService->delete($guide);

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Guide deleted successfully.');
    }
}
