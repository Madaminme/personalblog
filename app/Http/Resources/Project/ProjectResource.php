<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Type\TypeResource;
use Carbon\Carbon;
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
            'image' => $this->getFirstMedia('project-images')?->pluck('original_url'),
            'types' => TypeResource::collection($this->types),
            'tags' => TagResource::collection($this->tags),
            'completed_at' => Carbon::parse($this->completed_at)->format('m/d/Y')
        ];
    }
}
