<div class="form-grid">
    <div class="form-field">
        <label class="form-label" for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name', $guide->name ?? '') }}" class="form-input">
    </div>

    <div class="form-field">
        <label class="form-label" for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $guide->email ?? '') }}" class="form-input">
    </div>

    <div class="form-field">
        <label class="form-label" for="phone">Phone</label>
        <input id="phone" type="text" name="phone" value="{{ old('phone', $guide->phone ?? '') }}" class="form-input">
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="bio">Bio</label>
        <textarea id="bio" name="bio" rows="3" class="form-textarea">{{ old('bio', $guide->bio ?? '') }}</textarea>
    </div>

    <div class="form-field form-field--full">
        <label class="form-label" for="trip_ids">Assigned Flights</label>
        @php $assigned = old('trip_ids', isset($guide) ? $guide->trips->pluck('id')->all() : []); @endphp
        <select id="trip_ids" name="trip_ids[]" multiple class="form-select" style="height:10rem">
            @foreach ($trips as $trip)
                <option value="{{ $trip->id }}" @selected(in_array($trip->id, $assigned))>{{ $trip->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn--primary">Save</button>
    </div>
</div>
