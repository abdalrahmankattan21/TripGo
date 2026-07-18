@props(['status'])

@php
    $colors = [
        'scheduled' => 'bg-blue-100 text-blue-700',
        'ongoing' => 'bg-amber-100 text-amber-700',
        'completed' => 'bg-gray-200 text-gray-700',
        'cancelled' => 'bg-red-100 text-red-700',
        'pending_payment' => 'bg-amber-100 text-amber-700',
        'paid' => 'bg-green-100 text-green-700',
        'pending' => 'bg-amber-100 text-amber-700',
        'failed' => 'bg-red-100 text-red-700',
        'refunded' => 'bg-purple-100 text-purple-700',
        'waiting' => 'bg-amber-100 text-amber-700',
        'promoted' => 'bg-green-100 text-green-700',
    ];
    $class = $colors[$status] ?? 'bg-gray-100 text-gray-700';
@endphp

<span class="inline-block rounded-full px-3 py-1 text-xs font-medium {{ $class }}">
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>
