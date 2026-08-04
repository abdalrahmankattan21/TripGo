@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[['label' => 'Dashboard']]"/>
@endsection

@section('content')
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-admin.stat-card label="Total Trips" :value="$statistics['total_trips']"/>
        <x-admin.stat-card label="Total Bookings" :value="$statistics['total_bookings']"/>
        <x-admin.stat-card label="Total Users" :value="$statistics['total_users']"/>
        <x-admin.stat-card label="Total Revenue" :value="number_format($statistics['total_revenue'], 2)"/>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h5> أكثر الوجهات طلباً</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الوجهة</th>
                        <th>عدد الحجوزات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topDestinations as $index => $dest)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dest->name }}</td>
                            <td><span class="badge badge-primary">{{ $dest->total_bookings }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">لا توجد حجوزات لعرض الوجهات الأكثر طلباً.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <h2 class="mb-3 mt-8 text-sm font-semibold uppercase tracking-wide text-gray-500">Trips by Status</h2>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <x-admin.stat-card label="Scheduled" :value="$statistics['scheduled_trips']"/>
        <x-admin.stat-card label="In Progress" :value="$statistics['in_progress_trips']"/>
        <x-admin.stat-card label="Completed" :value="$statistics['completed_trips']"/>
    </div>
@endsection
