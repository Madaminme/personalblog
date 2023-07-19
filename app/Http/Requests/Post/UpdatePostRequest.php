<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
        $post = request()->route('post');
        return [
            'title' => ['nullable','string', 'max:150', Rule::unique('posts', 'title')->ignoreModel($post)],
            'slug' => ['nullable','string','max:150', Rule::unique('posts', 'slug')],
            'description' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'tags' => 'required|array',
            'tags*' => 'required|integer|exists:tags,id',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
            'instagram' => 'nullable|string|max:255|url',
            'github' => 'nullable|string|max:255|url',
            'published_at' => 'nullable|date'
        ];
    }
}
