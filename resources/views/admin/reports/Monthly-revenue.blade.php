@extends('admin.layouts.app')

@section('title', 'Monthly Revenue')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Monthly Revenue'],
    ]"/>
@endsection

@section('content')
    <form method="GET" action="{{ route('admin.reports.monthly-revenue') }}" class="admin-panel admin-panel--padded filter-bar">
        <div class="filter-field">
            <label for="date_from">Paid From</label>
            <input id="date_from" type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-field">
            <label for="date_to">Paid To</label>
            <input id="date_to" type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" class="form-input">
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn--primary">Filter</button>
            <a href="{{ route('admin.reports.monthly-revenue') }}" class="link-action link-action--view">Reset</a>
        </div>
    </form>

    <div class="admin-panel table-wrap" style="margin-top:1.25rem">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        <td class="is-mono">{{ $row['month'] }}</td>
                        <td class="is-mono">{{ number_format($row['revenue'], 2) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="table-empty">No data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
