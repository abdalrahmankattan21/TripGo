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
    <form method="GET" action="<?php echo e(route('admin.trips.index')); ?>"
          class="mb-4 grid grid-cols-1 gap-3 rounded-lg bg-white p-4 shadow sm:grid-cols-5">
        <div>
            <label class="block text-xs font-medium text-gray-500">Destination</label>
            <select name="destination_id" class="mt-1 w-full rounded border-gray-300 text-sm">
                <option value="">All</option>
                <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($destination->id); ?>" <?php if(($filters['destination_id'] ?? null) == $destination->id): echo 'selected'; endif; ?>>
                        <?php echo e($destination->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-500">Category</label>
            <select name="category_id" class="mt-1 w-full rounded border-gray-300 text-sm">
                <option value="">All</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php if(($filters['category_id'] ?? null) == $category->id): echo 'selected'; endif; ?>>
                        <?php echo e($category->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-500">Status</label>
            <select name="status" class="mt-1 w-full rounded border-gray-300 text-sm">
                <option value="">All</option>
                <?php $__currentLoopData = ['scheduled', 'in-progress', 'completed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status); ?>" <?php if(($filters['status'] ?? null) === $status): echo 'selected'; endif; ?>>
                        <?php echo e(ucfirst($status)); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-500">Start Date</label>
            <input type="date" name="start_date" value="<?php echo e($filters['start_date'] ?? ''); ?>"
                   class="mt-1 w-full rounded border-gray-300 text-sm">
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="rounded bg-gray-900 px-4 py-2 text-sm text-white">Filter</button>
            <a href="<?php echo e(route('admin.trips.index')); ?>" class="text-sm text-gray-600 hover:underline">Reset</a>
        </div>
    </form>

    <div class="mb-4 flex justify-end">
        <a href="<?php echo e(route('admin.trips.create')); ?>" class="rounded bg-gray-900 px-4 py-2 text-white">
            + New Trip
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Title</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Destination</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Category</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Price</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Seats</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Start Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Status</th>
                    <th class="px-4 py-3 text-right text-xs font-medium uppercase text-gray-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-3"><?php echo e($trip->title); ?></td>
                        <td class="px-4 py-3"><?php echo e($trip->destination->name ?? '—'); ?></td>
                        <td class="px-4 py-3"><?php echo e($trip->category->name ?? '—'); ?></td>
                        <td class="px-4 py-3"><?php echo e(number_format($trip->price, 2)); ?></td>
                        <td class="px-4 py-3"><?php echo e($trip->available_seats); ?> / <?php echo e($trip->total_seats); ?></td>
                        <td class="px-4 py-3"><?php echo e(optional($trip->start_date)->format('Y-m-d')); ?></td>
                        <td class="px-4 py-3"><?php if (isset($component)) { $__componentOriginal72ffe10338c4ec71bdf1582010227fb9 = $component; } ?>
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
<?php endif; ?></td>
                        <td class="px-4 py-3 space-x-2 text-right">
                            <a href="<?php echo e(route('admin.trips.show', $trip)); ?>" class="text-blue-600 hover:underline">View</a>
                            <a href="<?php echo e(route('admin.trips.edit', $trip)); ?>" class="text-amber-600 hover:underline">Edit</a>
                            <form action="<?php echo e(route('admin.trips.destroy', $trip)); ?>" method="POST" class="inline"
                                  onsubmit="return confirm('Delete this trip?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="8" class="px-4 py-6 text-center text-gray-500">No trips found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4"><?php echo e($trips->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\final\TripGo\resources\views/admin/trips/index.blade.php ENDPATH**/ ?>