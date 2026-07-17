@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[['label' => 'Dashboard']]"/>
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-admin.stat-card label="Total Trips" :value="$stats['total_trips']"/>
        <x-admin.stat-card label="Total Bookings" :value="$stats['total_bookings']"/>
        <x-admin.stat-card label="Total Users" :value="$stats['total_users']"/>
        <x-admin.stat-card label="Total Revenue" :value="number_format($stats['total_revenue'], 2)"/>
    </div>

    <h2 class="mb-3 mt-8 text-sm font-semibold uppercase tracking-wide text-gray-500">Trips by Status</h2>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <x-admin.stat-card label="Scheduled" :value="$stats['scheduled_trips']"/>
        <x-admin.stat-card label="In Progress" :value="$stats['in_progress_trips']"/>
        <x-admin.stat-card label="Completed" :value="$stats['completed_trips']"/>
    </div>
@endsection
