<?php

namespace App\Http\Resources\Tag;

use App\Http\Resources\Post\PostIndexResource;
use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagShowResource extends JsonResource
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
            'description' => $this->description,
            'post_number' => $this->whenLoaded('posts')->count(),
            'posts' => PostIndexResource::collection($this->whenLoaded('posts'))
        ];
    }
}
