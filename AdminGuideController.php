<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminGuideService;
use Illuminate\Http\Request;

class AdminGuideController extends Controller
{
    protected AdminGuideService $service;

    public function __construct(AdminGuideService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $guides = $this->service->getFilteredGuides($request);
        return view('admin.guides.index', compact('guides'));
    }

    public function show($id)
    {
        $guide = $this->service->getGuideById($id);
        return view('admin.guides.show', compact('guide'));
    }

    public function create()
    {
        return view('admin.guides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:guides,email',
            'phone' => 'required|string|max:20',
            'status' => 'in:active,inactive',
        ]);

        $this->service->createGuide($data);

        return redirect()->route('admin.guides.index')->with('success', 'تم إضافة المرشد بنجاح');
    }

    public function edit($id)
    {
        $guide = $this->service->getGuideById($id);
        return view('admin.guides.edit', compact('guide'));
    }

    public function update(Request $request, $id)
    {
        $guide = $this->service->getGuideById($id);

        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:guides,email,' . $id,
            'phone' => 'string|max:20',
            'status' => 'in:active,inactive',
        ]);

        $this->service->updateGuide($guide, $data);

        return redirect()->route('admin.guides.index')->with('success', 'تم تحديث بيانات المرشد بنجاح');
    }

    public function destroy($id)
    {
        $guide = $this->service->getGuideById($id);
        $this->service->deleteGuide($guide);

        return redirect()->route('admin.guides.index')->with('success', 'تم حذف المرشد بنجاح');
    }
}
