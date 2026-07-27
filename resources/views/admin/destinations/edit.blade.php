@extends('admin.layouts.app')

@section('title', 'Edit Destination')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Destinations', 'url' => route('admin.destinations.index')],
        ['label' => 'Edit'],
    ]"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.destinations.update', $destination) }}" enctype="multipart/form-data" class="rounded-lg bg-white p-6 shadow">
        @csrf
        @method('PUT')
        @include('admin.destinations._form')
    </form>
@endsection
