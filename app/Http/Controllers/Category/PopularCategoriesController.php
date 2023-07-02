<?php

namespace App\Http\Controllers\Category;

use App\Constants\ResponseConstants\CategoryResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class PopularCategoriesController extends Controller
{
    public function __invoke()
    {
        return $this->execute(function (){
            $category = Category::query()
                ->withCount('posts')
                ->orderByDesc('posts_count')
                ->limit(10)
                ->get();
            return CategoryResource::collection($category);
        }, CategoryResponseEnum::POPULAR_CATEGORY);
    }
}
