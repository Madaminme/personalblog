<?php

namespace App\Http\Controllers\Comment;

use App\Constants\ResponseConstants\CommentResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->execute(function (){
            $comment = Comment::all();
            return CommentResource::collection($comment);
        }, CommentResponseEnum::COMMENT_LIST);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        return $this->execute(function () use ($request){
            $comment = $this->commentService->store($request);
            return CommentResource::make($comment);
        }, CommentResponseEnum::COMMENT_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return $this->execute(function () use($comment){
            return CommentResource::make($comment);
        }, CommentResponseEnum::COMMENT_SHOW);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        return $this->execute(function () use ($request, $comment){
            $comment = $this->commentService->update($request, $comment);
            return CommentResource::make($comment);
        }, CommentResponseEnum::COMMENT_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        return $this->execute(function () use ($comment){
            $comment->delete();
        }, CommentResponseEnum::COMMENT_DELETE);
    }
}
