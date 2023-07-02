<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function store($request)
    {
        $comment = Comment::query()->create([
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id ?? null,
            'body' => $request->body
        ]);
        return $comment;
 }

    public function update($request, $comment)
    {
        $comment->update([
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id ?? $comment->parent_id,
            'body' => $request->body
        ]);
        return $comment;
    }
}
