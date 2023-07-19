<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory(10)->create();
        foreach (Post::all() as $post){
            $tags = Tag::query()->inRandomOrder()->take(rand(1,5))->pluck('id');
            $post->tags()->attach($tags);
        }
        foreach (Project::all() as $project){
            $tags = Tag::query()->inRandomOrder()->take(rand(1,5))->pluck('id');
            $project->tags()->attach($tags);
        }
    }
}
