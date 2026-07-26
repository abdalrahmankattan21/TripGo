@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Categories', 'url' => route('admin.categories.index')],
        ['label' => 'Edit'],
    ]"/>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="rounded-lg bg-white p-6 shadow">
        @csrf
        @method('PUT')
        @include('admin.categories._form')
    </form>
@endsection
