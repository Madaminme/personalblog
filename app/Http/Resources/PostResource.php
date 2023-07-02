<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'username' => $this->user->username,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body,
            'views' => $this->views,
            'image' => $this->resource->getMedia('post-images')->pluck('original_url'),
            'category' => $this->category->name,
            'tags' => TagResource::collection($this->tags),
            'comments' => CommentResource::collection($this->whenLoaded('comments'))
        ];
    }
}
