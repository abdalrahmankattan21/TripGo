@extends('admin.layouts.app')

@section('title', 'Trips')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips'],
    ]"/>
@endsection

@section('content')
    <form method="GET" action="{{ route('admin.trips.index') }}"
          class="mb-4 grid grid-cols-1 gap-3 rounded-lg bg-white p-4 shadow sm:grid-cols-5">
        <div>
            <label class="block text-xs font-medium text-gray-500">Destination</label>
            <select name="destination_id" class="mt-1 w-full rounded border-gray-300 text-sm">
                <option value="">All</option>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->id }}" @selected(($filters['destination_id'] ?? null) == $destination->id)>
                        {{ $destination->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-500">Category</label>
            <select name="category_id" class="mt-1 w-full rounded border-gray-300 text-sm">
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? null) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-500">Status</label>
            <select name="status" class="mt-1 w-full rounded border-gray-300 text-sm">
                <option value="">All</option>
                @foreach (['scheduled', 'in-progress', 'completed'] as $status)
                    <option value="{{ $status }}" @selected(($filters['status'] ?? null) === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-500">Start Date</label>
            <input type="date" name="start_date" value="{{ $filters['start_date'] ?? '' }}"
                   class="mt-1 w-full rounded border-gray-300 text-sm">
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Filter</button>
            <a href="{{ route('admin.trips.index') }}" class="text-sm text-gray-600 hover:underline">Reset</a>
        </div>
    </form>

    <div class="mb-4 flex justify-end">
        <a href="{{ route('admin.trips.create') }}" class="rounded bg-gray-900 px-4 py-2 text-white">
            + New Trip
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Destination</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Price</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Seats</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Start Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($trips as $trip)
                    <tr>
                        <td class="px-4 py-3">{{ $trip->title }}</td>
                        <td class="px-4 py-3">{{ $trip->destination->name ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $trip->category->name ?? '—' }}</td>
                        <td class="px-4 py-3">{{ number_format($trip->price, 2) }}</td>
                        <td class="px-4 py-3">{{ $trip->available_seats }} / {{ $trip->total_seats }}</td>
                        <td class="px-4 py-3">{{ optional($trip->start_date)->format('Y-m-d') }}</td>
                        <td class="px-4 py-3"><x-admin.status-badge :status="$trip->status"/></td>
                        <td class="px-4 py-3 space-x-2 text-right">
                            <a href="{{ route('admin.trips.show', $trip) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.trips.edit', $trip) }}" class="text-amber-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.trips.destroy', $trip) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this trip?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">No trips found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $trips->links() }}</div>
@endsection
