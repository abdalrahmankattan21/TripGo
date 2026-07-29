@extends('admin.layouts.app')

@section('title', 'Trips')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips'],
    ]"/>
@endsection

@section('content')
    <div
    class="mb-4 flex items-center justify-between gap-4">
            <form method="GET" action="{{ route('admin.trips.index') }}" class="flex-1 max-w-sm">
                <input type="text" name="search" value="{{request('search')}}" placeholder="Search by name..."
                    class="w-full rounded border-gray-300 text-sm">
            </form>

            <a href="{{ route('admin.trips.create') }}" class="rounded bg-gray-900 px-4 py-2 text-white">
                + New Trip
            </a>
        </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Title</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Destination</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Start Date</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">End Date</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse ($trips as $trip)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $trip->title }}</td>
                    <td class="px-6 py-4 text-sm text-ellipsis overflow-hidden whitespace-nowrap text-gray-900">{{ $trip->destination->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">Start Date:{{Carbon\Carbon::parse($trip->start_date)->format('Y-m-d')}}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">End Date:{{Carbon\Carbon::parse($trip->end_date)->format('Y-m-d')}}</td>
                    <td class="px-0.5 py-4 text-sm text-gray-900">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.trips.show', $trip) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.trips.edit', $trip) }}" class="text-amber-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.trips.destroy', $trip) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this trip?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">No trips found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
