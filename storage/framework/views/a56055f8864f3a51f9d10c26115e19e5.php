<?php $__env->startSection('title', $guide->name); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tour Guides', 'url' => route('admin.guides.index')],
        ['label' => $guide->name],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tour Guides', 'url' => route('admin.guides.index')],
        ['label' => $guide->name],
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
    <div class="detail-panel">
        <div class="detail-panel__header">
            <h2 class="detail-panel__title"><?php echo e($guide->name); ?></h2>
        </div>

        <dl class="detail-grid">
            <div><dt>Email</dt><dd style="font-family:var(--font-body)"><?php echo e($guide->email); ?></dd></div>
            <div><dt>Phone</dt><dd style="font-family:var(--font-body)"><?php echo e($guide->phone ?? '—'); ?></dd></div>
        </dl>

        <?php if($guide->bio): ?>
            <p style="margin-top:1rem;color:var(--ink-soft)"><?php echo e($guide->bio); ?></p>
        <?php endif; ?>

        <h3 class="stat-section-title">Assigned Flights</h3>
        <?php $__empty_1 = true; $__currentLoopData = $guide->trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <span class="badge badge--info" style="margin-right:0.5rem;margin-bottom:0.5rem"><?php echo e($trip->title); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="color:var(--ink-soft);font-size:0.875rem">No flights assigned.</p>
        <?php endif; ?>

        <div style="margin-top:1.5rem">
            <a href="<?php echo e(route('admin.guides.edit', $guide)); ?>" class="btn btn--primary">Edit</a>
            <a href="<?php echo e(route('admin.guides.index')); ?>" class="btn btn--ghost">Back</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pro\TripGo\resources\views/admin/guides/show.blade.php ENDPATH**/ ?>