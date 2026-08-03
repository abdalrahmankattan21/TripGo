@extends('admin.layouts.app')

@section('title', 'Trips')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips'],
    ]"/>
@endsection

@section('content')

    <form method="GET" action="{{ route('admin.trips.index') }}" class="admin-panel admin-panel--padded filter-bar">
        <div class="filter-field">
            <label for="trip_id">Trip</label>
            <select id="trip_id" name="trip_id" class="form-select">
                <option value="">All</option>
                @foreach ($trips as $trip)
                    <option value="{{ $trip->id }}" @selected(($filters['trip_id'] ?? null) == $trip->id)>{{ $trip->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-field">
            <label for="destination_id">Destination</label>
            <select id="destination_id" name="destination_id" class="form-select">
                <option value="">All</option>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->id }}" @selected(($filters['destination_id'] ?? null) == $destination->id)>{{ $destination->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-field">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? null) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-field">
            <label for="date_from">Start Date From</label>
            <input id="date_from" type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="date_to">Start Date To</label>
            <input id="date_to" type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="end_date_from">End Date From</label>
            <input id="end_date_from" type="date" name="end_date_from" value="{{ $filters['end_date_from'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="end_date_to">End Date To</label>
            <input id="end_date_to" type="date" name="end_date_to" value="{{ $filters['end_date_to'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="departure_point">Departure Point</label>
            <input id="departure_point" type="text" name="departure_point" value="{{ $filters['departure_point'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="price_from">Price From</label>
            <input id="price_from" type="number" name="price_from" value="{{ $filters['price_from'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="price_to">Price To</label>
            <input id="price_to" type="number" name="price_to" value="{{ $filters['price_to'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="">All</option>
                @foreach (['scheduled', 'in-progress', 'completed'] as $status)
                    <option value="{{ $status }}" @selected(($filters['status'] ?? null) === $status)>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="filter-actions">
            <button type="submit" class="btn btn--primary">Filter</button>
            <a href="{{ route('admin.trips.index') }}" class="link-action link-action--view">Reset</a>
        </div>

    </form>



    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Title</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Destination</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Departure Point</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Start Date</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">End Date</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Price</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Total Seats</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Available Seats</th>
                <th class="px-0.5 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Category</th>
                <th class="px-0.5 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Status</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse ($trips as $trip)
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $trip->title }}</td>
                    <td class="px-4 py-4 text-sm text-ellipsis overflow-hidden whitespace-nowrap text-gray-900">{{ $trip->destination->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $trip->departure_point }}</td>
                    <td class="px-10 py-4 text-sm text-gray-900">{{Carbon\Carbon::parse($trip->start_date)->format('Y-m-d')}}</td>
                    <td class="px-10 py-4 text-sm text-gray-900">{{Carbon\Carbon::parse($trip->end_date)->format('Y-m-d')}}</td>
                    <td class="px-12 py-4 text-sm text-gray-900">${{ number_format($trip->price, 2) }}</td>
                    <td class="px-4 py-4 text-sm text-gray-900">{{ $trip->total_seats }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $trip->available_seats }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $trip->category->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border
                            @if ($trip->status === 'scheduled')
                                bg-amber-100 text-amber-800 border-amber-200
                            @elseif ($trip->status === 'in_progress')
                                bg-emerald-100 text-emerald-800 border-emerald-200
                            @else
                                bg-rose-100 text-rose-800 border-rose-200
                            @endif
                        ">
                            {{ ucfirst(str_replace('_', ' ', $trip->status)) }}
                        </span>
                    </td>
                    <td class="px-60 py-4 text-sm text-gray-900">
                        <div class="px-4 py-1 space-x-2 text-right">
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
