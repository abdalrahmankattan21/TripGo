<div class="form-grid">
    <div class="form-field">
        <label class="form-label" for="name">Name</label>
        <input id="name" type="text" name="name" value="<?php echo e(old('name', $guide->name ?? '')); ?>" class="form-input">
    </div>

    <div class="form-field">
        <label class="form-label" for="email">Email</label>
        <input id="email" type="email" name="email" value="<?php echo e(old('email', $guide->email ?? '')); ?>" class="form-input">
    </div>

    <div class="form-field">
        <label class="form-label" for="phone">Phone</label>
        <input id="phone" type="text" name="phone" value="<?php echo e(old('phone', $guide->phone ?? '')); ?>" class="form-input">
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="bio">Bio</label>
        <textarea id="bio" name="bio" rows="3" class="form-textarea"><?php echo e(old('bio', $guide->bio ?? '')); ?></textarea>
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="trip_ids">Assigned Flights</label>
        <?php $assigned = old('trip_ids', isset($guide) ? $guide->trips->pluck('id')->all() : []); ?>
        <select id="trip_ids" name="trip_ids[]" multiple class="form-select" style="height:10rem">
            <?php $__currentLoopData = $trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($trip->id); ?>" <?php if(in_array($trip->id, $assigned)): echo 'selected'; endif; ?>><?php echo e($trip->title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn--primary">Save</button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\final\TripGo\resources\views/admin/guides/_form.blade.php ENDPATH**/ ?>