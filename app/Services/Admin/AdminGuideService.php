<?php

namespace App\Services\Admin;

use App\Models\Guide;

class AdminGuideService
{
    public function list($search = null)
    {
        return Guide::withCount('trips')
            ->Search($search)
            ->latest()
            ->paginate(15);
    }

    public function create(array $data)
    {
        $tripIds = $data['trip_ids'] ?? [];
        unset($data['trip_ids']);

        $guide = Guide::create($data);
        $guide->trips()->sync($tripIds);

        return $guide->fresh('trips');
    }

    public function update(Guide $guide, array $data)
    {
        $tripIds = $data['trip_ids'] ?? [];
        unset($data['trip_ids']);

        $guide->update($data);
        $guide->trips()->sync($tripIds);

        return $guide->fresh('trips');
    }

    public function delete(Guide $guide)
    {
        $guide->trips()->detach();
        $guide->delete();
    }
}
