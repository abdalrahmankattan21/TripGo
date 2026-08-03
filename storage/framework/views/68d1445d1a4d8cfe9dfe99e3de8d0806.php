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

    <form method="GET" action="<?php echo e(route('admin.trips.index')); ?>" class="admin-panel admin-panel--padded filter-bar">
        <div class="filter-field">
            <label for="trip_id">Trip</label>
            <select id="trip_id" name="trip_id" class="form-select">
                <option value="">All</option>
                <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($trip->id); ?>" <?php if(($filters['trip_id'] ?? null) == $trip->id): echo 'selected'; endif; ?>><?php echo e($trip->title); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="filter-field">
            <label for="destination_id">Destination</label>
            <select id="destination_id" name="destination_id" class="form-select">
                <option value="">All</option>
                <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($destination->id); ?>" <?php if(($filters['destination_id'] ?? null) == $destination->id): echo 'selected'; endif; ?>><?php echo e($destination->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="filter-field">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">All</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php if(($filters['category_id'] ?? null) == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="filter-field">
            <label for="date_from">Start Date From</label>
            <input id="date_from" type="date" name="date_from" value="<?php echo e($filters['date_from'] ?? ''); ?>" class="form-input">
        </div>

        <div class="filter-field">
            <label for="date_to">Start Date To</label>
            <input id="date_to" type="date" name="date_to" value="<?php echo e($filters['date_to'] ?? ''); ?>" class="form-input">
        </div>

        <div class="filter-field">
            <label for="end_date_from">End Date From</label>
            <input id="end_date_from" type="date" name="end_date_from" value="<?php echo e($filters['end_date_from'] ?? ''); ?>" class="form-input">
        </div>

        <div class="filter-field">
            <label for="end_date_to">End Date To</label>
            <input id="end_date_to" type="date" name="end_date_to" value="<?php echo e($filters['end_date_to'] ?? ''); ?>" class="form-input">
        </div>

        <div class="filter-field">
            <label for="departure_point">Departure Point</label>
            <input id="departure_point" type="text" name="departure_point" value="<?php echo e($filters['departure_point'] ?? ''); ?>" class="form-input">
        </div>

        <div class="filter-field">
            <label for="price_from">Price From</label>
            <input id="price_from" type="number" name="price_from" value="<?php echo e($filters['price_from'] ?? ''); ?>" class="form-input">
        </div>

        <div class="filter-field">
            <label for="price_to">Price To</label>
            <input id="price_to" type="number" name="price_to" value="<?php echo e($filters['price_to'] ?? ''); ?>" class="form-input">
        </div>

        <div class="filter-field">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="">All</option>
                <?php $__currentLoopData = ['scheduled', 'in-progress', 'completed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status); ?>" <?php if(($filters['status'] ?? null) === $status): echo 'selected'; endif; ?>>
                        <?php echo e(ucfirst(str_replace('_', ' ', $status))); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>


        <div class="filter-actions">
            <button type="submit" class="btn btn--primary">Filter</button>
            <a href="<?php echo e(route('admin.trips.index')); ?>" class="link-action link-action--view">Reset</a>
        </div>

    </form>



    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <table class="w-full">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Title</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Destination</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Departure Point</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Start Date</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">End Date</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Price</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Total Seats</th>
                <th class="px-6 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Available Seats</th>
                <th class="px-0.5 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Category</th>
                <th class="px-0.5 py-0.5 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Status</th>
                <th class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-left text-gray-500">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($trip->title); ?></td>
                    <td class="px-4 py-4 text-sm text-ellipsis overflow-hidden whitespace-nowrap text-gray-900"><?php echo e($trip->destination->name); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($trip->departure_point); ?></td>
                    <td class="px-10 py-4 text-sm text-gray-900"><?php echo e(Carbon\Carbon::parse($trip->start_date)->format('Y-m-d')); ?></td>
                    <td class="px-10 py-4 text-sm text-gray-900"><?php echo e(Carbon\Carbon::parse($trip->end_date)->format('Y-m-d')); ?></td>
                    <td class="px-12 py-4 text-sm text-gray-900">$<?php echo e(number_format($trip->price, 2)); ?></td>
                    <td class="px-4 py-4 text-sm text-gray-900"><?php echo e($trip->total_seats); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($trip->available_seats); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($trip->category->name); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border
                            <?php if($trip->status === 'scheduled'): ?>
                                bg-amber-100 text-amber-800 border-amber-200
                            <?php elseif($trip->status === 'in_progress'): ?>
                                bg-emerald-100 text-emerald-800 border-emerald-200
                            <?php else: ?>
                                bg-rose-100 text-rose-800 border-rose-200
                            <?php endif; ?>
                        ">
                            <?php echo e(ucfirst(str_replace('_', ' ', $trip->status))); ?>

                        </span>
                    </td>
                    <td class="px-60 py-4 text-sm text-gray-900">
                        <div class="px-4 py-1 space-x-2 text-right">
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

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Xacademy Tasks\TripGo\resources\views/admin/trips/index.blade.php ENDPATH**/ ?>