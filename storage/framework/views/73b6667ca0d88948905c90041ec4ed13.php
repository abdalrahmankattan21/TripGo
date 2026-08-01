<?php $__env->startSection('title', 'Trips'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips'],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Trips'],
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
    <div
    class="mb-4 flex items-center justify-between gap-4">
            <form method="GET" action="<?php echo e(route('admin.trips.index')); ?>" class="flex-1 max-w-sm">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by name..."
                    class="w-full rounded border-gray-300 text-sm">
            </form>

            <a href="<?php echo e(route('admin.trips.create')); ?>" class="rounded bg-gray-900 px-4 py-2 text-white">
                + New Trip
            </a>
        </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Title</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Destination</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Start Date</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">End Date</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($trip->title); ?></td>
                    <td class="px-6 py-4 text-sm text-ellipsis overflow-hidden whitespace-nowrap text-gray-900"><?php echo e($trip->destination->name); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900">Start Date:<?php echo e(Carbon\Carbon::parse($trip->start_date)->format('Y-m-d')); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900">End Date:<?php echo e(Carbon\Carbon::parse($trip->end_date)->format('Y-m-d')); ?></td>
                    <td class="px-0.5 py-4 text-sm text-gray-900">
                        <div class="flex items-center space-x-2">
                            <a href="<?php echo e(route('admin.trips.show', $trip)); ?>" class="text-blue-600 hover:underline">View</a>
                            <a href="<?php echo e(route('admin.trips.edit', $trip)); ?>" class="text-amber-600 hover:underline">Edit</a>
                            <form action="<?php echo e(route('admin.trips.destroy', $trip)); ?>" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this trip?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">No trips found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pro\TripGo\resources\views/admin/trips/index.blade.php ENDPATH**/ ?>