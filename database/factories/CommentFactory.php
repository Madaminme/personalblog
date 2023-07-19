<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $post = Post::query()->inRandomOrder()->first();
        return [
            'email' => $this->faker->email,
            'post_id' => $post->id,
            'body' => $this->faker->sentence(8),
            'remember_token' => Str::random(10),
        ];
    }
}
