<?php $__env->startSection('title', 'Tour Guides'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tour Guides'],
    ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.breadcrumb'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['items' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Tour Guides'],
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
    <div class="mb-4 flex items-center justify-between gap-4">
        <form method="GET" action="<?php echo e(route('admin.guides.index')); ?>" class="flex-1 max-w-sm">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search by name..."  class="w-full rounded border-gray-300 text-sm">
        </form>

        <a href="<?php echo e(route('admin.guides.create')); ?>" class="rounded bg-gray-900 px-4 py-2 text-white">+ New Guide</a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Phone</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Assigned Flights</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-3"><?php echo e($guide->name); ?></td>
                        <td class="px-4 py-3"><?php echo e($guide->email); ?></td>
                        <td class="px-4 py-3"><?php echo e($guide->phone ?? '—'); ?></td>
                        <td class="px-4 py-3"><?php echo e($guide->trips_count); ?></td>
                        <td class="px-4 py-3 space-x-2 text-right">
                            <a href="<?php echo e(route('admin.guides.show', $guide)); ?>" class="text-blue-600 hover:underline">View</a>
                            <a href="<?php echo e(route('admin.guides.edit', $guide)); ?>" class="text-amber-600 hover:underline">Edit</a>
                            <form action="<?php echo e(route('admin.guides.destroy', $guide)); ?>" method="POST" style="display:inline"
                                  onsubmit="return confirm('Delete this guide?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="table-empty">No guides found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top:1rem"><?php echo e($guides->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pro\TripGo\resources\views/admin/guides/index.blade.php ENDPATH**/ ?>