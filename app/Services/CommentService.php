<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Str;

class CommentService
{
    /**
     * @throws \Exception
     */
    public function store($validated)
    {
        if (isset($validated['parent_id'])){
        $post_id = Comment::findOrFail($validated['parent_id'])->post_id;
            if ($validated['post_id'] !== $post_id){
                throw new \Exception("Post does not have this parent comment ");
            }
        }


        $comment = Comment::query()->create([
            'email' => $validated['email'],
            'post_id' => $validated['post_id'],
            'parent_id' => $validated['parent_id'] ?? null,
            'body' => $validated['body'],
            'remember_token' => Str::random(10)
        ]);
        return $comment;
 }

    /**
     * @throws \Exception
     */
    public function update($validated, $comment)
    {
        if (isset($validated['parent_id'])){
            $post_id = Comment::findOrFail($validated['parent_id'])->post_id;
            if ($validated['post_id'] !== $post_id){
                throw new \Exception("Post does not have this parent comment ");
            }
        }
        if ($validated['token'] === $comment->remember_token){
            $comment->update([
                'email' => $validated['email'],
                'post_id' => $validated['post_id'],
                'parent_id' => $validated['parent_id'] ?? null,
                'body' => $validated['body'],
            ]);
        }
        return $comment;
    }
}
