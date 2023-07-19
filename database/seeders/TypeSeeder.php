<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::factory(10)->create();
        foreach (Project::all() as $project){
            $type = Type::query()->inRandomOrder()->take(rand(1,5))->pluck('id');
            $project->types()->attach($type);
        }
    }
}
