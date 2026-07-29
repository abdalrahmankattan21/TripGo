@extends('admin.layouts.app')

@section('title', 'Trip Details')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips', 'url' => route('admin.trips.index')],
        ['label' => 'Details'],
    ]"/>
@endsection

@section('content')
<h1 class="text-2xl font-semibold text-gray-900">Trip Details</h1>
    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Destination</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Start Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">End Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-3">{{ $trip->title }}</td>
                    <td class="px-4 py-3">{{ $trip->destination->name }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($trip->start_date)->format('Y-m-d') }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($trip->end_date)->format('Y-m-d') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.trips.index') }}" class="rounded bg-gray-900 px-4 py-2 text-gray-500">Back to Trips</a>
    </div>
@endsection
