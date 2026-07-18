<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin</title>

    {{-- Breeze/Vite pipeline for Alpine.js (needed by x-dropdown) and Tailwind reset. --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{--
        Custom admin design system. Vite only bundles files it knows about as
        entry points, so rather than adding a new entry (which needs a
        vite.config.js edit), add one line to the top of your existing
        resources/css/app.css:

            @import './admin.css';

        That pulls this file into the already-registered app.css build.
    --}}
</head>
<body class="admin-body">
{{-- هيدر Breeze الأصلي (resources/views/layouts/navigation.blade.php) —
     نفس الملف اللي بيستخدمه الـ dashboard الافتراضي بتاع Breeze، بما فيه
     قائمة المستخدم وزرار Log Out الجاهزين. --}}
@include('layouts.navigation')

<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <span class="admin-brand__mark">&#9992;</span>
            <span>TripGo</span>
        </div>
        <nav class="admin-nav">
            @php
                // Bookings / Tour Guides links will be added once those modules exist.
                $links = [
                    'admin.dashboard' => 'Dashboard',
                ];
            @endphp
            @foreach ($links as $route => $label)
                <a href="{{ route($route) }}"
                class="admin-nav-link {{ request()->routeIs(str_replace('.index', '', $route).'*') ? 'is-active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
    </aside>

    <div class="admin-main">
        <header class="admin-header">
            <div class="admin-header__row">
                <h1 class="admin-title">@yield('title', 'Dashboard')</h1>
            </div>

            @hasSection('breadcrumbs')
                <div class="admin-breadcrumb">@yield('breadcrumbs')</div>
            @endif
        </header>

        <main class="admin-content">
            <x-admin.alert/>
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
