<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\destinations\StoreDestinationRequest;
use App\Http\Requests\destinations\UpdateDestinationRequest;
use App\Models\Destination;
use App\Services\Admin\AdminDestinationService;
use Illuminate\Http\Request;

class AdminDestinationController extends Controller
{
    private AdminDestinationService $destinationService;
    public function __construct(AdminDestinationService $destinationService) {
        $this->destinationService = $destinationService;
    }

    public function index(Request $request)
    {
        return view('admin.destinations.index', [
            'destinations' => $this->destinationService->list($request->input('search') ? : null),
        ]);
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(StoreDestinationRequest $request)
    {
        $data = $request->validated();
        $this->destinationService->create($data, $request->file('image'));

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    public function show(Destination $destination)
    {
        return view('admin.destinations.show', [
            'destination' => $destination->loadCount('trips'),
        ]);
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        $data = $request->validated();
        $this->destinationService->update($destination, $data, $request->file('image')
        );

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        $this->destinationService->delete($destination);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destination deleted successfully.');
    }
}
