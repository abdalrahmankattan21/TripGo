<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="admin-body">

@include('layouts.navigation')

<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <span class="admin-brand__mark">&#9992;</span>
            <span>TripGo</span>
        </div>
        <nav class="admin-nav">
            @php
                $links = [
                    'admin.dashboard' => 'Dashboard',
                    'admin.destinations.index' => 'Destinations',
                    'admin.categories.index' => 'Categories',
                    'admin.trips.index' => 'Trips',
                    'admin.bookings.index' => 'Bookings',
                    'admin.guides.index' => 'Guides',
                ];

                $reportLinks = [
                    'admin.reports.pilgrims-revenue' => 'Pilgrims and Revenue',
                    'admin.reports.popular-destinations' => 'Most Popular Destinations',
                    'admin.reports.load-factor' => 'Flight Load Factor',
                    'admin.reports.monthly-revenue' => 'Monthly Revenue',
                    'admin.reports.cancellations' => 'Cancellation Reasons',
                ];
            @endphp
            @foreach ($links as $route => $label)
                <a href="{{ route($route) }}"
                class="admin-nav-link {{ request()->routeIs(str_replace('.index', '', $route).'*') ? 'is-active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
            <div x-data="{ open: {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open"
                        class="admin-nav-toggle {{ request()->routeIs('admin.reports.*') ? 'is-active' : '' }}">
                    <span>Reports</span>
                    <svg class="admin-nav-toggle__chevron" :class="{ 'is-open': open }"
                         width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" x-transition class="admin-nav-sub">
                    @foreach ($reportLinks as $route => $label)
                        <a href="{{ route($route) }}"
                           class="admin-nav-sub-link {{ request()->routeIs($route) ? 'is-active' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
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
