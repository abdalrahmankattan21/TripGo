@extends('admin.layouts.app')

@section('title', 'New Destination')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Destinations', 'url' => route('admin.destinations.index')],
        ['label' => 'New'],
    ]"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data" class="rounded-lg bg-white p-6 shadow">
        @csrf
        @include('admin.destinations._form')
    </form>
@endsection
