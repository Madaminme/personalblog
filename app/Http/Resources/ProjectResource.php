<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'client' => $this->client,
            'url' => $this->url,
            'image' => $this->resource->getMedia('project-images')->pluck('original_url'),
            'category_id' => $this->category->name
        ];
    }
}
