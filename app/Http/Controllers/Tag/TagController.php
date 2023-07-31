<?php

namespace App\Http\Controllers\Tag;

use App\Constants\ResponseConstants\TagResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\TagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Tag\TagShowResource;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    public function index()
    {
        return $this->execute(function () {
            $tags = Tag::all();
            return TagResource::collection($tags->load('posts')); //'posts' => withCount('posts')
        }, TagResponseEnum::TAG_LIST);
    }

    public function store(TagRequest $request)
    {
        return $this->execute(function () use ($request){
            $validated = $request->validated();
            $tag = Tag::query()->create($validated);
            if (isset($validated['image'])) {
                $tag->addMedia($validated['image'])->toMediaCollection('tag-images');
            }
            return TagResource::make($tag);
        },TagResponseEnum::TAG_CREATE);
    }

    public function show(Tag $tag)
    {
        return $this->execute(function () use ($tag){
            return TagShowResource::make($tag->load('posts'));
        }, TagResponseEnum::TAG_SHOW);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        return $this->execute(function () use ($request, $tag){
            $validated = $request->validated();
            $tag->update($validated);
            if (isset($validated['image'])) {
                $tag->clearMediaCollection('tag-images');
                $tag->addMedia($validated['image'])->toMediaCollection('tag-images');
            }
            return TagResource::make($tag);
        }, TagResponseEnum::TAG_UPDATE);
    }

    public function destroy(Tag $tag)
    {
        return $this->execute(function () use ($tag){
            if (isset($tag->image)) {
                $tag->clearMediaCollection('tag-images');
            }
            $tag->delete();
        }, TagResponseEnum::TAG_DELETE);
    }
}
