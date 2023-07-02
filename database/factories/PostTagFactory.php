<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post = Post::query()->inRandomOrder()->first();
        $tag = Tag::query()->inRandomOrder()->first();
        return [
            'post_id' => $post->id,
            'tag_id' => $tag->id,
        ];
    }
}
