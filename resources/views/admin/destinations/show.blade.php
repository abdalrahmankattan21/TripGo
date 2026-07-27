@extends('admin.layouts.app')

@section('title', $destination->name)

@section('content')
    <div class="rounded-lg bg-white p-6 shadow">
        @if ($destination->image)
            <img src="{{ Storage::url($destination->image) }}" alt="{{ $destination->name }}"
                 class="mb-4 h-48 w-full rounded object-cover">
        @endif

        <h2 class="text-lg font-semibold">{{ $destination->name }}</h2>
        <p class="mt-2 text-gray-600">{{ $destination->description }}</p>
        <p class="mt-4 text-sm text-gray-500">{{ $destination->trips_count }} trip(s)</p>

        <div class="mt-6">
            <a href="{{ route('admin.destinations.edit', $destination) }}" class="rounded bg-gray-900 px-4 py-2 text-white">Edit</a>
            <a href="{{ route('admin.destinations.index') }}" class="ml-2 text-gray-600 hover:underline">Back</a>
        </div>
    </div>
@endsection
