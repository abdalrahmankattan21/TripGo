@extends('admin.layouts.app')

@section('title', 'Tour Guides')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tour Guides'],
    ]"/>
@endsection

@section('content')
    <div class="mb-4 flex items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.guides.index') }}" class="flex-1 max-w-sm">
            <input type="text" name="search" value="{{request('search') }}" placeholder="Search by name..."  class="w-full rounded border-gray-300 text-sm">
        </form>

        <a href="{{ route('admin.guides.create') }}" class="rounded bg-gray-900 px-4 py-2 text-white">+ New Guide</a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Phone</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Assigned Flights</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($guides as $guide)
                    <tr>
                        <td class="px-4 py-3">{{ $guide->name }}</td>
                        <td class="px-4 py-3">{{ $guide->email }}</td>
                        <td class="px-4 py-3">{{ $guide->phone ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $guide->trips_count }}</td>
                        <td class="px-4 py-3 space-x-2 text-right">
                            <a href="{{ route('admin.guides.show', $guide) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.guides.edit', $guide) }}" class="text-amber-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.guides.destroy', $guide) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Delete this guide?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="table-empty">No guides found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1rem">{{ $guides->links() }}</div>
@endsection
