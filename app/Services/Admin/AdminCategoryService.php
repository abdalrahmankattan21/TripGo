<?php

namespace App\Services\Admin;

use App\Models\Category;

class AdminCategoryService
{
    public function list($search = null)
    {
        return Category::withCount('trips')
            ->Search($search)
            ->latest()
            ->paginate(15);
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);

        return $category->fresh();
    }

    public function delete(Category $category)
    {
        $category->delete();
    }
}
