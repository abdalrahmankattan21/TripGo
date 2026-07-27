@extends('admin.layouts.app')

@section('title', 'Categories')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Categories'],
    ]"/>
@endsection

@section('content')
    <div class="mb-4 flex items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="flex-1 max-w-sm">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..."
                   class="w-full rounded border-gray-300 text-sm">
        </form>

        <a href="{{ route('admin.categories.create') }}" class="rounded bg-gray-900 px-4 py-2 text-white">
            + New Category
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Trips</th>
                    <th class="px-4 py-3 text-right text-xs font-medium uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-4 py-3">{{ $category->name }}</td>
                        <td class="px-4 py-3">{{ $category->trips_count }}</td>
                        <td class="px-4 py-3 space-x-2 text-right">
                            <a href="{{ route('admin.categories.show', $category) }}" class="text-blue-600 hover:underline">View</a>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-amber-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-6 text-center text-gray-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $categories->links() }}</div>
@endsection
