@extends('admin.layouts.app')

@section('title', 'Edit Trip')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips', 'url' => route('admin.trips.index')],
        ['label' => 'Edit'],
    ]"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.trips.update', $trip->id) }}" enctype="multipart/form-data" class="rounded-lg bg-white p-6 shadow">
        @csrf
        @method('PUT')
        @include('admin.trips._form')
    </form>
@endsection
