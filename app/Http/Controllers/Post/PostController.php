<?php

namespace App\Http\Controllers\Post;

use App\Constants\ResponseConstants\PostResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\Post\PostIndexResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\ShowPostResource;
use App\Jobs\ProcessPostPublish;
use App\Models\Comment;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Support\Carbon;

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
        return $this->execute(function () {
            $posts = Post::query()->where('is_published', '=', true)->paginate(5);
            return PostIndexResource::collection($posts);
        }, PostResponseEnum::POST_LIST);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        return $this->execute(function () use ($request) {
            $validated = $request->validated();
            $post = $this->postService->store($validated);
            if (key_exists('published_at', $validated)){
                ProcessPostPublish::dispatch($post)->delay(Carbon::make($validated['published_at']));
            }
            return PostResource::make($post);
        }, PostResponseEnum::POST_CREATE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return $this->execute(function () use ($post) {
            $post->views++;
            $post->save();
            return ShowPostResource::make($post);
        }, PostResponseEnum::POST_SHOW);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        return $this->execute(function () use ($request, $post) {
            $post = $this->postService->update($request->validated(), $post);
            return PostResource::make($post);
        }, PostResponseEnum::POST_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        return $this->execute(function () use ($post) {
            $this->postService->delete($post);
        }, PostResponseEnum::POST_DELETE);
    }

    public function recent()
    {
        return $this->execute(function () {
            $posts = Post::query()->latest()->limit(5)->get();
            return PostIndexResource::collection($posts);
        }, PostResponseEnum::RECENT_POST);
    }

    public function popular()
    {
        return $this->execute(function () {
            $populars = Post::query()->orderByDesc('views')->limit(5)->get();
            return PostIndexResource::collection($populars);
        }, PostResponseEnum::POPULAR_POSTS);
    }

    public function featured()
    {
        return $this->execute(function () {
            $featured = Post::withCount('comments')->orderBy('comments_count', 'desc')->get();
            return PostIndexResource::collection($featured);
        }, PostResponseEnum::FEATURED_POSTS);
    }

    public function comments(int $postId)
    {
        return $this->execute(function () use ($postId) {
            $comments = Comment::query()
                ->with('replies')
                ->where('post_id', '=', $postId)
                ->paginate(5);

            return CommentResource::collection($comments);
        }, PostResponseEnum::POST_COMMENTS);
    }
}
