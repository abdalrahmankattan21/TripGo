<div class="form-grid">
    <div class="form-field form-field--full">
        <label class="form-label" for="title">Title</label>
        <input id="title" type="text" name="title" value="{{ old('title', $trip->title ?? '') }}" class="form-input">
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="description">Description</label>
        <textarea id="description" name="description" rows="4" class="form-textarea">{{ old('description', $trip->description ?? '') }}</textarea>
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="image">Image</label>
        @if (!empty($trip?->image))
            <img src="{{ Storage::url($trip->image) }}" class="form-thumb">
        @endif
        <input id="image" type="file" name="image" accept="image/*" class="form-file">
    </div>

    <div class="form-field">
        <label class="form-label" for="destination_id">Destination</label>
        <select id="destination_id" name="destination_id" class="form-select">
            @foreach ($destinations as $destination)
                <option value="{{ $destination->id }}" @selected(old('destination_id', $trip->destination_id ?? null) == $destination->id)>
                    {{ $destination->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-field">
        <label class="form-label" for="category_id">Category</label>
        <select id="category_id" name="category_id" class="form-select">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $trip->category_id ?? null) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-field">
        <label class="form-label" for="price">Price</label>
        <input id="price" type="number" step="0.01" name="price" value="{{ old('price', $trip->price ?? '') }}" class="form-input">
    </div>

    <div class="form-field">
        <label class="form-label" for="departure_point">Departure Point</label>
        <input id="departure_point" type="text" name="departure_point" value="{{ old('departure_point', $trip->departure_point ?? '') }}" class="form-input">
    </div>

    <div class="form-field">
        <label class="form-label" for="start_date">Start Date</label>
        <input id="start_date" type="datetime-local" name="start_date"
               value="{{ old('start_date', isset($trip) ? optional($trip->start_date)->format('Y-m-d\TH:i') : '') }}"
               class="form-input">
    </div>

      <div class="form-field">
        <label class="form-label" for="end_date">End Date</label>
        <input id="end_date" type="datetime-local" name="end_date"
               value="{{ old('end_date', isset($trip) ? optional($trip->end_date)->format('Y-m-d\TH:i') : '') }}"
               class="form-input">
    </div>

    <div class="form-field">
        <label class="form-label" for="booking_cancel_deadline">Cancel Deadline</label>
        <input id="booking_cancel_deadline" type="datetime-local" name="booking_cancel_deadline"
               value="{{ old('booking_cancel_deadline', isset($trip) ? optional($trip->booking_cancel_deadline)->format('Y-m-d\TH:i') : '') }}"
               class="form-input">
    </div>

    <div class="form-field">
        <label class="form-label" for="total_seats">Total Seats</label>
        <input id="total_seats" type="number" name="total_seats" value="{{ old('total_seats', $trip->total_seats ?? '') }}" class="form-input">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn--primary">Save</button>
    </div>
</div>
