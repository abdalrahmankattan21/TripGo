<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Traits\ApiResponseTrait;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
     use ApiResponseTrait;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return $this->success(
            'Categories retrieved successfully.',
            $this->categoryService->getAllCategories()
        );
    }
}
