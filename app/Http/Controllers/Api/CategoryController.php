<?php

namespace App\Http\Controllers\Api;

use App\Filters\AccommodationFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\AccommodationFilterRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    protected CategoryService $categoryService;

    /**
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @param AccommodationFilter $filter
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(AccommodationFilter $filter): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = $this->categoryService->getCategoriesWithCount($filter);

        return CategoryResource::collection($categories);

    }
}
