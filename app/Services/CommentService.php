<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Str;

class CommentService
{
    public function store($validated)
    {
        $comment = Comment::query()->create([
            'email' => $validated['email'],
            'post_id' => $validated['post_id'],
            'parent_id' => $validated['parent_id'] ?? null,
            'body' => $validated['body'],
            'remember_token' => Str::random(10)
        ]);
        return $comment;
 }

    public function update($validated, $comment)
    {
        $comment->update([
            'email' => $validated->email,
            'post_id' => $validated->post_id,
            'parent_id' => $validated->parent_id ?? $comment->parent_id,
            'body' => $validated->body
        ]);
        return $comment;
    }
}
