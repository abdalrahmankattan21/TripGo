<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
    <input type="text" name="title" id="title" value="{{ old('title', $trip->title ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    @error('title')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="destination_id" class="block text-sm font-medium text-gray-700">Destination</label>
    <select name="destination_id" id="destination_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @foreach ($destinations as $destination)
            <option value="{{ $destination->id }}" {{ old('destination_id', $trip->destination_id ?? '') == $destination->id ? 'selected' : '' }}>{{ $destination->name }}</option>
        @endforeach
    </select>
    @error('destination_id')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', isset($trip->start_date) ? \Carbon\Carbon::parse($trip->start_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    @error('start_date')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', isset($trip->end_date) ? \Carbon\Carbon::parse($trip->end_date)->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    @error('end_date')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="total_seats" class="block text-sm font-medium text-gray-700">Total Seats</label>
    <input type="number" name="total_seats" id="total_seats" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('total_seats', $trip->total_seats ?? '') }}">
    @error('total_seats')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="departure_point" class="block text-sm font-medium text-gray-700">Departure Point</label>
    <input type="string" name="departure_point" id="departure_point" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('departure_point', $trip->departure_point ?? '') }}">
    @error('departure_point')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
    <input type="number" name="price" id="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('price', $trip->price ?? '') }}">
    @error('price')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
    <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $trip->description ?? '') }}</textarea>
    @error('description')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
    <input type="file" name="image" id="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    @error('image')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
    <select name="category_id" id="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id', $trip->category_id ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        <option value="scheduled" {{ old('status', $trip->status ?? '') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
        <option value="in-progress" {{ old('status', $trip->status ?? '') == 'in-progress' ? 'selected' : '' }}>In Progress </option>
        <option value="completed" {{ old('status', $trip->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
    @error('status')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>


<div class="mb-4">
    <label for="guides" class="block text-sm font-medium text-gray-700">Guides</label>
    <select name="guides[]" id="guides" multiple class="mt-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @foreach ($guides as $guide)
            <option value="{{ $guide->id }}" {{in_array($guide->id, old('guides', $trip?->guides?->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>{{ $guide->name }}</option>
        @endforeach
    </select>
    @error('guides')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="form-actions">
        <button type="submit" class="btn btn--primary">Save</button>
</div>
