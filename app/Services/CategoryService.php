<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class CategoryService
{
    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store($validated)
    {
        $validated['slug'] = str()->slug($validated['name']);
        $category = Category::query()->create($validated);

        if (!is_null($validated['icon'])) {
                $category->addMedia($validated['icon'])->toMediaCollection('category-icons');
        }
        return $category;
    }

    public function update($validated, $category)
    {
        $validated['slug'] = str()->slug($validated['name']);
        $category->update($validated);

        if (isset($validated['icon'])) {
            $category->clearMediaCollection('category-icons');
            $category->addMedia($validated['icon'])->toMediaCollection('category-icons');
        }
        return $category;
    }

    public function delete($category): void
    {
        $category->clearMediaCollection('category-icons');
        $category->delete();
    }
}
