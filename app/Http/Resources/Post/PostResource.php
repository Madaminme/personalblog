<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\CommentResource;
use App\Http\Resources\Tag\TagResource;
use Carbon\Carbon;
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
        $body = str_word_count($this->body);
        return [
            'id' => $this->id,
            'username' => $this->user->username,
            'slug' => $this->slug,
            'title' => $this->title,
            'body' => $this->body,
            'views' => $this->views,
            'read_time' => ceil($body/config("custom.read_time")),
            'image' => $this->getFirstMedia('post-images')?->getUrl(),
            'category' => $this->category->name,
            'instagram' => $this->instagram,
            'github' => $this->github,
            'tags' => TagResource::collection($this->tags),
            'published_at' => Carbon::parse($this->published_at)->format('m/d/Y H:i')
        ];
    }
}
