<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\CommentResource;
use App\Http\Resources\Tag\TagResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowPostResource extends JsonResource
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
            'body' => $this->body,
            'views' => $this->views,
            'image' => $this->resource->getMedia('post-images')->pluck('original_url'),
            'category' => $this->category->name,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'published_at' => Carbon::parse($this->published_at)->format('m/d/Y')
        ];
    }
}
