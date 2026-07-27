@extends('admin.layouts.app')

@section('title', $category->name)

@section('content')
    <div class="rounded-lg bg-white p-6 shadow">
        <h2 class="text-lg font-semibold">{{ $category->name }}</h2>
        <p class="mt-2 text-gray-600">{{ $category->description }}</p>
        <p class="mt-4 text-sm text-gray-500">{{ $category->trips_count }} trip(s)</p>

        <div class="mt-6">
            <a href="{{ route('admin.categories.edit', $category) }}" class="rounded bg-gray-900 px-4 py-2 text-white">Edit</a>
            <a href="{{ route('admin.categories.index') }}" class="ml-2 text-gray-600 hover:underline">Back</a>
        </div>
    </div>
@endsection
