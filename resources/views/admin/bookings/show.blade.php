@extends('admin.layouts.app')

@section('title', 'Booking #' . $booking->id)

@section('breadcrumbs')
    <x-admin.breadcrumb :items="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Bookings', 'url' => route('admin.bookings.index')],
        ['label' => '#' . $booking->id],
    ]"/>
@endsection

@section('content')
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(18rem,1fr));gap:1.25rem">

        <div class="detail-panel">
            <h2 class="stat-section-title" style="margin-top:0">Booking Details</h2>
            <dl class="detail-grid" style="grid-template-columns:1fr">
                <div><dt>Status</dt><dd><x-admin.status-badge :status="$booking->status"/></dd></div>
                <div><dt>Seats</dt><dd>{{ $booking->seats }}</dd></div>
                <div><dt>Total Price</dt><dd>{{ number_format($booking->total_price, 2) }}</dd></div>
                <div><dt>Booked At</dt><dd>{{ optional($booking->booked_at)->format('Y-m-d H:i') }}</dd></div>
                @if ($booking->status === 'cancelled')
                    <div><dt>Cancelled At</dt><dd>{{ optional($booking->cancelled_at)->format('Y-m-d H:i') }}</dd></div>
                    @if (isset($booking->cancellation_reason))
                        <div><dt>Cancellation Reason</dt><dd style="font-family:var(--font-body)">{{ $booking->cancellation_reason }}</dd></div>
                    @endif
                @endif
            </dl>
        </div>

        <div class="detail-panel">
            <h2 class="stat-section-title" style="margin-top:0">Pilgrim</h2>
            <p style="font-family:var(--font-body)">{{ $booking->user->name ?? 'N/A' }}</p>
            <p style="color:var(--ink-soft);font-size:0.875rem">{{ $booking->user->email ?? '' }}</p>
        </div>

        <div class="detail-panel">
            <h2 class="stat-section-title" style="margin-top:0">Flight</h2>
            <p style="font-family:var(--font-body)">{{ $booking->trip->title ?? 'N/A' }}</p>
            <p style="color:var(--ink-soft);font-size:0.875rem">Start: {{ optional($booking->trip?->start_date)->format('Y-m-d') }}</p>
        </div>

        <div class="detail-panel">
            <h2 class="stat-section-title" style="margin-top:0">Payment</h2>
            @if ($booking->payment)
                <dl class="detail-grid" style="grid-template-columns:1fr">
                    <div><dt>Status</dt><dd><x-admin.status-badge :status="$booking->payment->status"/></dd></div>
                    <div><dt>Amount</dt><dd>{{ number_format($booking->payment->amount, 2) }}</dd></div>
                    <div><dt>Paid At</dt><dd>{{ optional($booking->payment->created_at)->format('Y-m-d H:i') ?? '—' }}</dd></div>
                </dl>
            @else
                <p style="color:var(--ink-soft);font-size:0.875rem">No payment record.</p>
            @endif
        </div>

        <div class="detail-panel" style="grid-column:1/-1">
            <h2 class="stat-section-title" style="margin-top:0">Companions</h2>
            @forelse ($booking->companions as $companion)
                <span class="badge badge--neutral" style="margin-right:0.5rem;margin-bottom:0.5rem">
                    {{ $companion->name }} @if($companion->national_id) ({{ $companion->national_id }}) @endif
                </span>
            @empty
                <p style="color:var(--ink-soft);font-size:0.875rem">No companions.</p>
            @endforelse
        </div>
    </div>

    <a href="{{ route('admin.bookings.index') }}" class="btn btn--ghost" style="margin-top:1.5rem">Back to bookings</a>
@endsection
