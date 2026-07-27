<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categories\StoreCategoryRequest;
use App\Http\Requests\categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Admin\AdminCategoryService;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    private  AdminCategoryService $categoryService;
    public function __construct(AdminCategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        return view('admin.categories.index', [
            'categories' => $this->categoryService->list($request->input('search') ? : null)
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $this->categoryService->create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'category' => $category->loadCount('trips'),
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $this->categoryService->update($category, $request->validated());

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->delete($category);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
