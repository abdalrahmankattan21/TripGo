<?php $__env->startSection('title', $trip->title); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips', 'url' => route('admin.trips.index')],
        ['label' => $trip->title],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips', 'url' => route('admin.trips.index')],
        ['label' => $trip->title],
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
    <div class="rounded-lg bg-white p-6 shadow">
        <?php if($trip->image): ?>
            <img src="<?php echo e($trip->image == "image" ? asset('images/trip.jpg') : Storage::url($trip->image)); ?>" class="mb-4 h-48 w-full rounded object-cover">
        <?php endif; ?>

        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold"><?php echo e($trip->title); ?></h2>
            <?php if (isset($component)) { $__componentOriginal72ffe10338c4ec71bdf1582010227fb9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.status-badge','data' => ['status' => $trip->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($trip->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal72ffe10338c4ec71bdf1582010227fb9)): ?>
<?php $attributes = $__attributesOriginal72ffe10338c4ec71bdf1582010227fb9; ?>
<?php unset($__attributesOriginal72ffe10338c4ec71bdf1582010227fb9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72ffe10338c4ec71bdf1582010227fb9)): ?>
<?php $component = $__componentOriginal72ffe10338c4ec71bdf1582010227fb9; ?>
<?php unset($__componentOriginal72ffe10338c4ec71bdf1582010227fb9); ?>
<?php endif; ?>
        </div>

        <p class="mt-2 text-gray-600"><?php echo e($trip->description); ?></p>

        <dl class="mt-4 grid grid-cols-2 gap-y-2 text-sm md:grid-cols-3">
            <div><dt class="text-gray-500">Destination</dt><dd><?php echo e($trip->destination->name ?? '—'); ?></dd></div>
            <div><dt class="text-gray-500">Category</dt><dd><?php echo e($trip->category->name ?? '—'); ?></dd></div>
            <div><dt class="text-gray-500">Price</dt><dd><?php echo e(number_format($trip->price, 2)); ?></dd></div>
            <div><dt class="text-gray-500">Departure Point</dt><dd><?php echo e($trip->departure_point); ?></dd></div>
            <div><dt class="text-gray-500">Start Date</dt><dd><?php echo e(optional($trip->start_date)->format('Y-m-d H:i')); ?></dd></div>
            <div><dt class="text-gray-500">End Date</dt><dd><?php echo e(optional($trip->end_date)->format('Y-m-d H:i')); ?></dd></div>
            <div><dt class="text-gray-500">Cancel Deadline</dt><dd><?php echo e(optional($trip->booking_cancel_deadline)->format('Y-m-d H:i')); ?></dd></div>
            <div><dt class="text-gray-500">Total Seats</dt><dd><?php echo e($trip->total_seats); ?></dd></div>
            <div><dt class="text-gray-500">Available Seats</dt><dd><?php echo e($trip->available_seats); ?></dd></div>
        </dl>

        <div class="mt-6">
            <a href="<?php echo e(route('admin.trips.edit', $trip)); ?>" class="rounded bg-gray-900 px-4 py-2 text-white">Edit</a>
            <a href="<?php echo e(route('admin.trips.index')); ?>" class="ml-2 text-gray-600 hover:underline">Back</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\final\TripGo\resources\views/admin/trips/show.blade.php ENDPATH**/ ?>