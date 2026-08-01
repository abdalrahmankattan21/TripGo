@extends('admin.layouts.app')

@section('title', $trip->title)

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips', 'url' => route('admin.trips.index')],
        ['label' => $trip->title],
    ]"/>
@endsection

@section('content')
    <div class="rounded-lg bg-white p-6 shadow">
        @if ($trip->image)
            <img src="{{ Storage::url($trip->image) }}" class="mb-4 h-48 w-full rounded object-cover">
        @endif

        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">{{ $trip->title }}</h2>
            <x-admin.status-badge :status="$trip->status"/>
        </div>

        <p class="mt-2 text-gray-600">{{ $trip->description }}</p>

        <dl class="mt-4 grid grid-cols-2 gap-y-2 text-sm md:grid-cols-3">
            <div><dt class="text-gray-500">Destination</dt><dd>{{ $trip->destination->name ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">Category</dt><dd>{{ $trip->category->name ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">Price</dt><dd>{{ number_format($trip->price, 2) }}</dd></div>
            <div><dt class="text-gray-500">Departure Point</dt><dd>{{ $trip->departure_point }}</dd></div>
            <div><dt class="text-gray-500">Start Date</dt><dd>{{ optional($trip->start_date)->format('Y-m-d H:i') }}</dd></div>
            <div><dt class="text-gray-500">Cancel Deadline</dt><dd>{{ optional($trip->booking_cancel_deadline)->format('Y-m-d H:i') }}</dd></div>
            <div><dt class="text-gray-500">Total Seats</dt><dd>{{ $trip->total_seats }}</dd></div>
            <div><dt class="text-gray-500">Available Seats</dt><dd>{{ $trip->available_seats }}</dd></div>
        </dl>

        <div class="mt-6">
            <a href="{{ route('admin.trips.edit', $trip) }}" class="rounded bg-gray-900 px-4 py-2 text-white">Edit</a>
            <a href="{{ route('admin.trips.index') }}" class="ml-2 text-gray-600 hover:underline">Back</a>
        </div>
    </div>
@endsection
