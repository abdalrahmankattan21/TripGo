<div class="form-grid">
    <div class="form-field form-field--full">
        <label class="form-label" for="name">Name</label>
        <input id="name" type="text" name="name" value="<?php echo e(old('name', $category->name ?? '')); ?>" class="form-input">
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="description">Description</label>
        <textarea id="description" name="description" rows="4" class="form-textarea"><?php echo e(old('description', $category->description ?? '')); ?></textarea>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn--primary">Save</button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Xacademy Tasks\TripGo\resources\views/admin/categories/_form.blade.php ENDPATH**/ ?>