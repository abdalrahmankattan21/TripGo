@extends('admin.layouts.app')

@section('title', 'New Guide')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tour Guides', 'url' => route('admin.guides.index')],
        ['label' => 'New'],
    ]"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.guides.store') }}" class="admin-panel admin-panel--padded">
        @csrf
        @include('admin.guides._form')
    </form>
@endsection
