<?php

namespace App\Http\Controllers\Tag;

use App\Constants\ResponseConstants\TagResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Tag\TagResource;
use App\Models\Tag;

class PopularTagsController extends Controller
{
    public function __invoke()
    {
        return $this->execute(function (){
            $tags = Tag::query()
                ->withCount('posts')
                ->orderByDesc('posts_count')
                ->limit(12)
                ->get();
            return TagResource::collection($tags);
        }, TagResponseEnum::TAG_POPULAR);
       }
}
