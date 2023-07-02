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
        $validated['user_id'] = auth()->id();
        $validated['slug'] = str()->slug($validated['title']);
        $post = Post::query()->create($validated);

        if (!is_null($images = \Arr::get($validated, 'images'))) {
            foreach ($images as $image) {
                $post->addMedia($image)->toMediaCollection('post-images');
            }
        }
        return $post;
    }

    public function update($validated, $post)
    {
        $validated['user_id'] = auth()->id();
        $validated['slug'] = str()->slug($validated['title']);
        $post->update($validated);

        if (!is_null($images = \Arr::get($validated, 'images'))) {
            $post->clearMediaCollection('post-images');
            foreach ($images as $image) {
                $post->addMedia($image)->toMediaCollection('post-images');
            }

        }
        return $post;
    }

    public function delete($post): void
    {
        if (isset($post->image))
        {
            Storage::delete($post->image);
        }
        $post->delete();
    }
}
