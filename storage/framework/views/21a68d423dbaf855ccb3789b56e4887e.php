<?php $__env->startSection('title', 'New Booking'); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <?php if (isset($component)) { $__componentOriginaldbbc880c47f621cda59b70d6eb356b2f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldbbc880c47f621cda59b70d6eb356b2f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.breadcrumb','data' => ['items' => [
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Bookings', 'url' => route('admin.bookings.index')],
        ['label' => 'New'],
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
        ['label' => 'New'],
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
    <form method="POST" action="<?php echo e(route('admin.bookings.store')); ?>" class="admin-panel admin-panel--padded" id="booking-form">
        <?php echo csrf_field(); ?>

        <div class="form-grid">
            <div class="form-field">
                <label class="form-label" for="user_id">Pilgrim</label>
                <select id="user_id" name="user_id" class="form-select">
                    <option value="">Select a user...</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php if(old('user_id') == $user->id): echo 'selected'; endif; ?>>
                            <?php echo e($user->name); ?> (<?php echo e($user->email); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-field">
                <label class="form-label" for="trip_id">Flight</label>
                <select id="trip_id" name="trip_id" class="form-select">
                    <option value="">Select a trip...</option>
                    <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($trip->id); ?>" <?php if(old('trip_id') == $trip->id): echo 'selected'; endif; ?>><?php echo e($trip->title); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p class="form-hint">Only scheduled trips are listed. Seats and price are calculated automatically.</p>
            </div>

            <div class="form-field form-field--full">
                <label class="form-label">Companions</label>
                <p class="form-hint">
                    The pilgrim booking counts as 1 seat automatically — add a row here for each
                    additional companion travelling with them.
                </p>

                <div id="companion-rows" style="display:flex;flex-direction:column;gap:0.6rem;margin-top:0.5rem">
                    <?php $oldCompanions = old('companions', []); ?>
                    <?php $__empty_1 = true; $__currentLoopData = $oldCompanions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $companion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="companion-row" style="display:flex;gap:0.6rem">
                            <input type="text" name="companions[<?php echo e($i); ?>][name]" value="<?php echo e($companion['name'] ?? ''); ?>"
                                   placeholder="Companion name" class="form-input">
                            <input type="text" name="companions[<?php echo e($i); ?>][national_id]" value="<?php echo e($companion['national_id'] ?? ''); ?>"
                                   placeholder="National ID (optional)" class="form-input">
                            <button type="button" class="link-action link-action--danger" onclick="this.closest('.companion-row').remove()">Remove</button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <?php endif; ?>
                </div>

                <button type="button" id="add-companion" class="btn btn--ghost" style="margin-top:0.75rem">+ Add Companion</button>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn--primary">Create Booking</button>
            </div>
        </div>
    </form>

    <script>
        (function () {
            var container = document.getElementById('companion-rows');
            var index = container.children.length;

            document.getElementById('add-companion').addEventListener('click', function () {
                var row = document.createElement('div');
                row.className = 'companion-row';
                row.style.display = 'flex';
                row.style.gap = '0.6rem';
                row.innerHTML =
                    '<input type="text" name="companions[' + index + '][name]" placeholder="Companion name" class="form-input">' +
                    '<input type="text" name="companions[' + index + '][national_id]" placeholder="National ID (optional)" class="form-input">' +
                    '<button type="button" class="link-action link-action--danger" onclick="this.closest(\'.companion-row\').remove()">Remove</button>';
                container.appendChild(row);
                index++;
            });
        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pro\TripGo\resources\views/admin/bookings/create.blade.php ENDPATH**/ ?>