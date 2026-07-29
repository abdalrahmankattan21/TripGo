<div class="form-grid">
    <div class="form-field form-field--full">
        <label class="form-label" for="name">Name</label>
        <input id="name" type="text" name="name" value="<?php echo e(old('name', $destination->name ?? '')); ?>" class="form-input">
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="description">Description</label>
        <textarea id="description" name="description" rows="4" class="form-textarea"><?php echo e(old('description', $destination->description ?? '')); ?></textarea>
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="image">Image</label>
        <?php if(!empty($destination?->image)): ?>
            <img src="<?php echo e(Storage::url($destination->image)); ?>" alt="<?php echo e($destination->name); ?>" class="form-thumb">
        <?php endif; ?>
        <input id="image" type="file" name="image" accept="image/*" class="form-file">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn--primary">Save</button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Xacademy Tasks\TripGo\resources\views/admin/destinations/_form.blade.php ENDPATH**/ ?>