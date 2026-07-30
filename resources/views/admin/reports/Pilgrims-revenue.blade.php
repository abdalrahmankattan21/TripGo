@extends('admin.layouts.app')

@section('title', 'Pilgrims and Revenue')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Pilgrims and Revenue'],
    ]"/>
@endsection

@section('content')
    <form method="GET" action="{{ route('admin.reports.pilgrims-revenue') }}" class="admin-panel admin-panel--padded filter-bar">
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


        <div class="filter-field">
            <label for="date_from">Start Date From</label>
            <input id="date_from" type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="date_to">Start Date To</label>
            <input id="date_to" type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn--primary">Filter</button>
            <a href="{{ route('admin.reports.pilgrims-revenue') }}" class="link-action link-action--view">Reset</a>
        </div>
    </form>

    <div class="admin-panel table-wrap" style="margin-top:1.25rem">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Flight</th>
                    <th>Destination</th>
                    <th>Bookings</th>
                    <th>Pilgrims</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td>{{ $row['flight_name'] }}</td>
                        <td>{{ $row['destination'] }}</td>
                        <td class="is-numeric">{{ $row['bookings_count'] }}</td>
                        <td class="is-numeric">{{ $row['pilgrims_count'] }}</td>
                        <td class="is-mono">{{ number_format($row['revenue'], 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="table-empty">No data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
