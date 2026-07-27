@extends('admin.layouts.app')

@section('title', 'New Category')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Categories', 'url' => route('admin.categories.index')],
        ['label' => 'New'],
    ]"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.categories.store') }}" class="rounded-lg bg-white p-6 shadow">
        @csrf
        @include('admin.categories._form')
    </form>
@endsection
