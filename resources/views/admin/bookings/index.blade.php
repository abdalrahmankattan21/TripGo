@extends('admin.layouts.app')

@section('title', 'Bookings')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Bookings'],
    ]"/>
@endsection

@section('content')
    <form method="GET" action="{{ route('admin.bookings.index') }}" class="admin-panel admin-panel--padded filter-bar">
        <div class="filter-field">
            <label for="trip_id">Flight</label>
            <select id="trip_id" name="trip_id" class="form-select">
                <option value="">All</option>
                @foreach ($trips as $trip)
                    <option value="{{ $trip->id }}" @selected(($filters['trip_id'] ?? null) == $trip->id)>{{ $trip->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-field">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="">All</option>
                @foreach (['pending_payment', 'confirmed', 'cancelled'] as $status)
                    <option value="{{ $status }}" @selected(($filters['status'] ?? null) === $status)>
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-field">
            <label for="date_from">Booked From</label>
            <input id="date_from" type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="date_to">Booked To</label>
            <input id="date_to" type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn--primary">Filter</button>
            <a href="{{ route('admin.bookings.index') }}" class="link-action link-action--view">Reset</a>
        </div>
    </form>


    <div class="admin-panel table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Pilgrim</th>
                    <th>Flight</th>
                    <th>Seats</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Booked At</th>
                    <th class="actions-cell">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ $booking->trip->title ?? 'N/A' }}</td>
                        <td class="is-numeric">{{ $booking->seats }}</td>
                        <td class="is-mono">{{ number_format($booking->total_price, 2) }}</td>
                        <td><x-admin.status-badge :status="$booking->status"/></td>
                        <td class="is-mono">{{ optional($booking->booked_at)->format('Y-m-d H:i') }}</td>
                        <td class="actions-cell">
                            <a href="{{ route('admin.bookings.show', $booking) }}" class="text-blue-600 hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="table-empty">No bookings found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1rem">{{ $bookings->links() }}</div>
@endsection
