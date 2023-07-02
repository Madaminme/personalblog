<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();
        $category = Category::query()->inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'slug' => $this->faker->slug,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(100),
            'body' => $this->faker->text(255),
            'views' => $this->faker->numberBetween(1, 25),
            'category_id' => $category->id,
        ];
    }
}
