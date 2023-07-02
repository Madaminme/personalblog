<?php

namespace App\Services;

use App\Models\Project;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ProjectService
{
    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store($validated)
    {
        $validated['slug'] = str()->slug($validated['name']);
        $project = Project::query()->create($validated);

        if (!is_null($images = \Arr::get($validated, 'images'))) {
            foreach ($images as $image) {
                $project->addMedia($image)->toMediaCollection('project-images');
            }
        }
        return $project;
    }

    public function update($validated, $project)
    {
        $validated['slug'] = str()->slug($validated['name']);
        $project->update($validated);
        if (!is_null($images = \Arr::get($validated, 'images'))) {
            $project->clearMediaCollection('project-images');
            foreach ($images as $image) {
                $project->addMedia($image)->toMediaCollection('project-images');
            }
        }
        return $project;
    }
}
