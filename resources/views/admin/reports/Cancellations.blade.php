@extends('admin.layouts.app')

@section('title', 'Cancellation Reasons')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Cancellation Reasons'],
    ]"/>
@endsection

@section('content')
    <form method="GET" action="{{ route('admin.reports.cancellations') }}" class="admin-panel admin-panel--padded filter-bar">
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
            <label for="date_from">Cancelled From</label>
            <input id="date_from" type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="date_to">Cancelled To</label>
            <input id="date_to" type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn--primary">Filter</button>
            <a href="{{ route('admin.reports.cancellations') }}" class="link-action link-action--view">Reset</a>
        </div>
    </form>

    <div class="admin-panel table-wrap" style="margin-top:1.25rem">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Booking</th>
                    <th>Pilgrim</th>
                    <th>Trip</th>
                    <th>Cancelled At</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td class="is-mono">#{{ $row['booking_id'] }}</td>
                        <td>{{ $row['user_name'] }}</td>
                        <td>{{ $row['flight_name'] }}</td>
                        <td class="is-mono">{{ optional($row['cancelled_at'])->format('Y-m-d H:i') }}</td>
                        <td>{{ $row['reason'] ?? '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="table-empty">No cancellations.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
