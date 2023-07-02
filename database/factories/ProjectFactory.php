<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::query()->inRandomOrder()->first();
        return [
            'name' => $this->faker->sentence(4),
            'slug' => $this->faker->slug,
            'client' => $this->faker->company,
            'url' => $this->faker->domainName,
            'category_id' => $category->id
        ];
    }
}
