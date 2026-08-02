<div class="form-grid">
    <div class="form-field form-field--full">
        <label class="form-label" for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $destination->name ?? '') }}" class="form-input">
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="description">Description</label>
        <textarea id="description" name="description" rows="4" class="form-textarea">{{ old('description', $destination->description ?? '') }}</textarea>
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="image">Image</label>
        @if (!empty($destination?->image))
            <img src="{{$destination->image == "image" ? asset('images/destination.jpg') : Storage::url($destination->image) }}" alt="{{ $destination->name }}" class="form-thumb">
        @endif
        <input id="image" type="file" name="image" accept="image/*" class="form-file">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn--primary">Save</button>
    </div>
</div>
