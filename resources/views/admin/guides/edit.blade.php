@extends('admin.layouts.app')

@section('title', 'Edit Guide')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tour Guides', 'url' => route('admin.guides.index')],
        ['label' => 'Edit'],
    ]"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.guides.update', $guide) }}" class="admin-panel admin-panel--padded">
        @csrf
        @method('PUT')
        @include('admin.guides._form')
    </form>
@endsection
