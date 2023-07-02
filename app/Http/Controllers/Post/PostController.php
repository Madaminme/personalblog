<?php

namespace App\Http\Controllers\Post;

use App\Constants\ResponseConstants\PostResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostIndexResource;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->execute(function (){
            $posts = Post::all();
            return PostIndexResource::collection($posts);
        }, PostResponseEnum::POST_LIST);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        return $this->execute(function () use ($request){
            $post = $this->postService->store($request->validated());
            return PostResource::make($post);
        }, PostResponseEnum::POST_CREATE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $this->execute(function () use ($post){
           $post->views ++;
           $post->save();
           return PostResource::make($post->load('comments'));
        }, PostResponseEnum::POST_SHOW);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        return $this->execute(function () use ($request, $post){
            $post = $this->postService->update($request->validated(), $post);
            return PostResource::make($post);
        }, PostResponseEnum::POST_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $this->execute(function () use ($post){
            $this->postService->delete($post);
        }, PostResponseEnum::POST_DELETE);
    }
}
