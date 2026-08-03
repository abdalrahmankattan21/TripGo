<?php

namespace App\Services\Admin;

use App\Models\Destination;
use Illuminate\Support\Facades\Storage;

class AdminDestinationService
{
    public function list($search = null)
    {

        return Destination::withCount('trips')
            ->Search($search)
            ->latest()
            ->paginate(15);

    }

    public function create(array $data, $image = null)
    {
        if ($image !== null) {
            $data['image'] = $this->storeImage($image);
        }

        return Destination::create($data);
    }

    public function update(Destination $destination, array $data, $image = null)
    {
        if ($image !== null) {
            $this->deleteImage($destination);
            $data['image'] = $this->storeImage($image);
        }

        $destination->update($data);

        return $destination->fresh();
    }

    public function delete(Destination $destination)
    {
        $this->deleteImage($destination);
        $destination->delete();
    }

    private function storeImage($image)
    {
        return $image->store('destinations', 'public');
    }

    private function deleteImage(Destination $destination)
    {
        if ($destination->image) {
            Storage::disk('public')->delete($destination->image);
        }
    }
}
