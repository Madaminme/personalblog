<?php

namespace App\Http\Controllers\Tag;

use App\Constants\ResponseConstants\TagResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        return $this->execute(function () {
            $tags = Tag::all();
            return TagResource::collection($tags);
        }, TagResponseEnum::TAG_LIST);
    }

    public function store(TagRequest $request)
    {
        return $this->execute(function () use ($request){
            $tag = Tag::query()->create($request->validated());
            return TagResource::make($tag);
        },TagResponseEnum::TAG_CREATE);
    }

    public function show(Tag $tag)
    {
        return $this->execute(function () use ($tag){
            return TagResource::make($tag);
        }, TagResponseEnum::TAG_SHOW);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        return $this->execute(function () use ($request, $tag){
            $tag->update($request->validated());
            return TagResource::make($tag);
        }, TagResponseEnum::TAG_UPDATE);
    }

    public function destroy(Tag $tag)
    {
        return $this->execute(function () use ($tag){
            $tag->delete();
        }, TagResponseEnum::TAG_DELETE);
    }
}
