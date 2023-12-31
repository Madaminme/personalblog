<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:150|unique:posts,title',
            'slug' => 'nullable|string|max:150|unique:posts,slug',
            'description' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'tags' => 'required|array',
            'tags*' => 'required|integer|exists:tags,id',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
            'instagram' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'published_at' => ['nullable', 'date', 'after_or_equal:' . now()->format('Y-m-d-H-i')]
        ];
    }
}
