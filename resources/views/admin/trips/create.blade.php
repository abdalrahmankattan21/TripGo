@extends('admin.layouts.app')

@section('title', 'New Trip')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips', 'url' => route('admin.trips.index')],
        ['label' => 'New'],
    ]"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.trips.store') }}" enctype="multipart/form-data" class="rounded-lg bg-white p-6 shadow">
        @csrf
        @include('admin.trips._form')
    </form>
@endsection
