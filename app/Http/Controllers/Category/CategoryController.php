<?php

namespace App\Http\Controllers\Category;

use App\Constants\ResponseConstants\CategoryResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->execute(function () {
            $categories = Category::all();
            return CategoryResource::collection($categories);
        }, CategoryResponseEnum::CATEGORY_LIST);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        return $this->execute(function () use ($request) {
                $category = $this->categoryService->store($request->validated());
            return CategoryResource::make($category);
        }, CategoryResponseEnum::CATEGORY_CREATE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->execute(function () use ($category){
           return CategoryResource::make($category);
        }, CategoryResponseEnum::CATEGORY_SHOW);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return $this->execute(function () use ($request, $category){
            $category = $this->categoryService->update($request->validated(), $category);
            return CategoryResource::make($category);
        }, CategoryResponseEnum::CATEGORY_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $this->execute(function () use ($category){
            $this->categoryService->delete($category);
        }, CategoryResponseEnum::CATEGORY_DELETE);

    }
}
