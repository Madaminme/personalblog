<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PostService
{
    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store(array $validated)
    {
        $validated['slug'] = $validated['slug'] ?? str()->slug($validated['title']);
        $validated['user_id'] = auth()->id();
        $validated['read_time'] = ceil(str_word_count($validated['body']) / 150);

        $post = Post::query()->create($validated);

        $post->tags()->attach($validated['tags']);

        if (isset($validated['image'])) {
            $post->addMedia($validated['image'])->toMediaCollection('post-images');
        }

        return $post;
    }

    public function update($validated, $post)
    {
        if (!isset($validated['slug'])) {
            $validated['slug'] = str()->slug($validated['title']);
        }
        $validated['user_id'] = auth()->id();
        $validated['read_time'] = ceil(str_word_count($validated['body']) / 150);
        $post->update($validated);
        $post->tags()->sync($validated['tags']);
        if (isset($validated['image'])) {
            $post->clearMediaCollection('post-images');
            $post->addMedia($validated['image'])->toMediaCollection('post-images');
        }

        return $post;
    }

    public function delete($post): void
    {
        $post->tags()->detach();
        if (isset($post->image)) {
            Storage::delete($post->image);
        }
        $post->delete();
    }
}
