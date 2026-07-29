<?php if(session('success')): ?>
    <div class="mb-4 rounded border border-green-300 bg-green-50 px-4 py-3 text-green-800">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="mb-4 rounded border border-red-300 bg-red-50 px-4 py-3 text-red-800">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="mb-4 rounded border border-red-300 bg-red-50 px-4 py-3 text-red-800">
        <ul class="list-disc pl-5">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Xacademy Tasks\TripGo\resources\views/components/admin/alert.blade.php ENDPATH**/ ?>