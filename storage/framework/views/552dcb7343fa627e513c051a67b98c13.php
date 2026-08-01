<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - Admin</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

</head>
<body class="admin-body">

<?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="admin-shell">
    <aside class="admin-sidebar">
        <div class="admin-brand">
            <span class="admin-brand__mark">&#9992;</span>
            <span>TripGo</span>
        </div>
        <nav class="admin-nav">
            <?php
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
                    'admin.reports.occupancy-rate' => 'Trip Occupancy Rate',
                    'admin.reports.monthly-revenue' => 'Monthly Revenue',
                    'admin.reports.cancellations' => 'Cancellation Reasons',
                ];
            ?>
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route($route)); ?>"
                class="admin-nav-link <?php echo e(request()->routeIs(str_replace('.index', '', $route).'*') ? 'is-active' : ''); ?>">
                    <?php echo e($label); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div x-data="{ open: <?php echo e(request()->routeIs('admin.reports.*') ? 'true' : 'false'); ?> }">
                <button type="button" @click="open = !open"
                        class="admin-nav-toggle <?php echo e(request()->routeIs('admin.reports.*') ? 'is-active' : ''); ?>">
                    <span>Reports</span>
                    <svg class="admin-nav-toggle__chevron" :class="{ 'is-open': open }"
                         width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" x-transition class="admin-nav-sub">
                    <?php $__currentLoopData = $reportLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route($route)); ?>"
                           class="admin-nav-sub-link <?php echo e(request()->routeIs($route) ? 'is-active' : ''); ?>">
                            <?php echo e($label); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </nav>
    </aside>

    <div class="admin-main">
        <header class="admin-header">
            <div class="admin-header__row">
                <h1 class="admin-title"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
            </div>

            <?php if (! empty(trim($__env->yieldContent('breadcrumbs')))): ?>
                <div class="admin-breadcrumb"><?php echo $__env->yieldContent('breadcrumbs'); ?></div>
            <?php endif; ?>
        </header>

        <main class="admin-content">
            <?php if (isset($component)) { $__componentOriginald888329b8246e32afd68d2decbd25cf1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald888329b8246e32afd68d2decbd25cf1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald888329b8246e32afd68d2decbd25cf1)): ?>
<?php $attributes = $__attributesOriginald888329b8246e32afd68d2decbd25cf1; ?>
<?php unset($__attributesOriginald888329b8246e32afd68d2decbd25cf1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald888329b8246e32afd68d2decbd25cf1)): ?>
<?php $component = $__componentOriginald888329b8246e32afd68d2decbd25cf1; ?>
<?php unset($__componentOriginald888329b8246e32afd68d2decbd25cf1); ?>
<?php endif; ?>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\final\TripGo\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>