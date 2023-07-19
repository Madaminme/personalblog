<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Tag\TagResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $body = str_word_count($this->body);
        return [
            'id' => $this->id,
            'username' => $this->user->username,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'read_time' => ceil($body/150),
            'views' => $this->views,
            'image' => $this->getFirstMedia('post-images')?->getUrl(),
            'category' => $this->category->name,
            'tags' => TagResource::collection($this->tags)
        ];
    }
}
