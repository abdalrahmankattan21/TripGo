<?php $__env->startSection('title', 'Booking #' . $booking->id); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Bookings', 'url' => route('admin.bookings.index')],
        ['label' => '#' . $booking->id],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Bookings', 'url' => route('admin.bookings.index')],
        ['label' => '#' . $booking->id],
    ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f)): ?>
<?php $attributes = $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f; ?>
<?php unset($__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldbbc880c47f621cda59b70d6eb356b2f)): ?>
<?php $component = $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f; ?>
<?php unset($__componentOriginaldbbc880c47f621cda59b70d6eb356b2f); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(18rem,1fr));gap:1.25rem">

        <div class="detail-panel">
            <h2 class="stat-section-title" style="margin-top:0">Booking Details</h2>
            <dl class="detail-grid" style="grid-template-columns:1fr">
                <div><dt>Status</dt><dd><?php if (isset($component)) { $__componentOriginal72ffe10338c4ec71bdf1582010227fb9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status-badge','data' => ['status' => $booking->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($booking->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72ffe10338c4ec71bdf1582010227fb9)): ?>
<?php $attributes = $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9; ?>
<?php unset($__attributesOriginal72ffe10338c4ec71bdf1582010227fb9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72ffe10338c4ec71bdf1582010227fb9)): ?>
<?php $component = $__componentOriginal72ffe10338c4ec71bdf1582010227fb9; ?>
<?php unset($__componentOriginal72ffe10338c4ec71bdf1582010227fb9); ?>
<?php endif; ?></dd></div>
                <div><dt>Seats</dt><dd><?php echo e($booking->seats); ?></dd></div>
                <div><dt>Total Price</dt><dd><?php echo e(number_format($booking->total_price, 2)); ?></dd></div>
                <div><dt>Booked At</dt><dd><?php echo e(optional($booking->booked_at)->format('Y-m-d H:i')); ?></dd></div>
                <?php if($booking->status === 'cancelled'): ?>
                    <div><dt>Cancelled At</dt><dd><?php echo e(optional($booking->cancelled_at)->format('Y-m-d H:i')); ?></dd></div>
                    <?php if(isset($booking->cancellation_reason)): ?>
                        <div><dt>Cancellation Reason</dt><dd style="font-family:var(--font-body)"><?php echo e($booking->cancellation_reason); ?></dd></div>
                    <?php endif; ?>
                <?php endif; ?>
            </dl>
        </div>

        <div class="detail-panel">
            <h2 class="stat-section-title" style="margin-top:0">Pilgrim</h2>
            <p style="font-family:var(--font-body)"><?php echo e($booking->user->name ?? 'N/A'); ?></p>
            <p style="color:var(--ink-soft);font-size:0.875rem"><?php echo e($booking->user->email ?? ''); ?></p>
        </div>

        <div class="detail-panel">
            <h2 class="stat-section-title" style="margin-top:0">Trip</h2>
            <p style="font-family:var(--font-body)"><?php echo e($booking->trip->title ?? 'N/A'); ?></p>
            <p style="color:var(--ink-soft);font-size:0.875rem">Start: <?php echo e(optional($booking->trip?->start_date)->format('Y-m-d')); ?></p>
        </div>

        <div class="detail-panel">
            <h2 class="stat-section-title" style="margin-top:0">Payment</h2>
            <?php if($booking->payment): ?>
                <dl class="detail-grid" style="grid-template-columns:1fr">
                    <div><dt>Status</dt><dd><?php if (isset($component)) { $__componentOriginal72ffe10338c4ec71bdf1582010227fb9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status-badge','data' => ['status' => $booking->payment->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($booking->payment->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72ffe10338c4ec71bdf1582010227fb9)): ?>
<?php $attributes = $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9; ?>
<?php unset($__attributesOriginal72ffe10338c4ec71bdf1582010227fb9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72ffe10338c4ec71bdf1582010227fb9)): ?>
<?php $component = $__componentOriginal72ffe10338c4ec71bdf1582010227fb9; ?>
<?php unset($__componentOriginal72ffe10338c4ec71bdf1582010227fb9); ?>
<?php endif; ?></dd></div>
                    <div><dt>Amount</dt><dd><?php echo e(number_format($booking->payment->amount, 2)); ?></dd></div>
                    <div><dt>Paid At</dt><dd><?php echo e(optional($booking->payment->created_at)->format('Y-m-d H:i') ?? '—'); ?></dd></div>
                </dl>
            <?php else: ?>
                <p style="color:var(--ink-soft);font-size:0.875rem">No payment record.</p>
            <?php endif; ?>
        </div>

        <div class="detail-panel" style="grid-column:1/-1">
            <h2 class="stat-section-title" style="margin-top:0">Companions</h2>
            <?php $__empty_1 = true; $__currentLoopData = $booking->companions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $companion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <span class="badge badge--neutral" style="margin-right:0.5rem;margin-bottom:0.5rem">
                    <?php echo e($companion->name); ?> <?php if($companion->national_id): ?> (<?php echo e($companion->national_id); ?>) <?php endif; ?>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p style="color:var(--ink-soft);font-size:0.875rem">No companions.</p>
            <?php endif; ?>
        </div>
    </div>

    <a href="<?php echo e(route('admin.bookings.index')); ?>" class="btn btn--ghost" style="margin-top:1.5rem">Back to bookings</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pro\TripGo\resources\views/admin/bookings/show.blade.php ENDPATH**/ ?>