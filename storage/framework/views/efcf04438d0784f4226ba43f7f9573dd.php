<?php $__env->startSection('title', $destination->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="rounded-lg bg-white p-6 shadow">
        <?php if($destination->image): ?>
            <img src="<?php echo e($destination->image == 'image' ? asset('images/destination.jpg') : Storage::url($destination->image)); ?>" alt="<?php echo e($destination->name); ?>"
                 class="mb-4 h-48 w-full rounded object-cover">
        <?php endif; ?>

        <h2 class="text-lg font-semibold"><?php echo e($destination->name); ?></h2>
        <p class="mt-2 text-gray-600"><?php echo e($destination->description); ?></p>
        <p class="mt-4 text-sm text-gray-500"><?php echo e($destination->trips_count); ?> trip(s)</p>

        <div class="mt-6">
            <a href="<?php echo e(route('admin.destinations.edit', $destination)); ?>" class="rounded bg-gray-900 px-4 py-2 text-white">Edit</a>
            <a href="<?php echo e(route('admin.destinations.index')); ?>" class="ml-2 text-gray-600 hover:underline">Back</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\final\TripGo\resources\views/admin/destinations/show.blade.php ENDPATH**/ ?>