<?php $__env->startSection('title', $category->name); ?>

<?php $__env->startSection('content'); ?>
    <div class="rounded-lg bg-white p-6 shadow">
        <h2 class="text-lg font-semibold"><?php echo e($category->name); ?></h2>
        <p class="mt-2 text-gray-600"><?php echo e($category->description); ?></p>
        <p class="mt-4 text-sm text-gray-500"><?php echo e($category->trips_count); ?> trip(s)</p>

        <div class="mt-6">
            <a href="<?php echo e(route('admin.categories.edit', $category)); ?>" class="rounded bg-gray-900 px-4 py-2 text-white">Edit</a>
            <a href="<?php echo e(route('admin.categories.index')); ?>" class="ml-2 text-gray-600 hover:underline">Back</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Xacademy Tasks\TripGo\resources\views/admin/categories/show.blade.php ENDPATH**/ ?>