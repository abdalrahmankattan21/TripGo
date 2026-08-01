@extends('admin.layouts.app')

@section('title', 'Occpancy Rate')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trip Occupancy Rate'],
    ]"/>
@endsection

@section('content')
    <form method="GET" action="{{ route('admin.reports.occupancy-rate') }}" class="admin-panel admin-panel--padded filter-bar">
        <div class="filter-field">
            <label for="destination_id">Destination</label>
            <select id="destination_id" name="destination_id" class="form-select">
                <option value="">All</option>
                @foreach ($destinations as $destination)
                    <option value="{{ $destination->id }}" @selected(($filters['destination_id'] ?? null) == $destination->id)>
                        {{ $destination->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-field">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">All</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? null) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <div class="filter-actions">
            <button type="submit" class="btn btn--primary">Filter</button>
            <a href="{{ route('admin.reports.occupancy-rate') }}" class="link-action link-action--view">Reset</a>
        </div>
    </form>

    <div class="admin-panel table-wrap" style="margin-top:1.25rem">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Trip</th>
                    <th>Booked / Total Seats</th>
                    <th>Occupancy Rate</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>{{ $row['flight_name'] }}</td>
                        <td class="is-numeric">{{ $row['booked_seats'] }} / {{ $row['total_seats'] }}</td>
                        <td class="is-numeric">{{ $row['occupancy_rate'] }}%</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="table-empty">No data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
