@extends('admin.layouts.app')

@section('title', $guide->name)

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tour Guides', 'url' => route('admin.guides.index')],
        ['label' => $guide->name],
    ]"/>
@endsection

@section('content')
    <div class="detail-panel">
        <div class="detail-panel__header">
            <h2 class="detail-panel__title">{{ $guide->name }}</h2>
        </div>

        <dl class="detail-grid">
            <div><dt>Email</dt><dd style="font-family:var(--font-body)">{{ $guide->email }}</dd></div>
            <div><dt>Phone</dt><dd style="font-family:var(--font-body)">{{ $guide->phone ?? '—' }}</dd></div>
        </dl>

        @if ($guide->bio)
            <p style="margin-top:1rem;color:var(--ink-soft)">{{ $guide->bio }}</p>
        @endif

        <h3 class="stat-section-title">Assigned Flights</h3>
        @forelse ($guide->trips as $trip)
            <span class="badge badge--info" style="margin-right:0.5rem;margin-bottom:0.5rem">{{ $trip->title }}</span>
        @empty
            <p style="color:var(--ink-soft);font-size:0.875rem">No flights assigned.</p>
        @endforelse

        <div style="margin-top:1.5rem">
            <a href="{{ route('admin.guides.edit', $guide) }}" class="btn btn--primary">Edit</a>
            <a href="{{ route('admin.guides.index') }}" class="btn btn--ghost">Back</a>
        </div>
    </div>
@endsection
