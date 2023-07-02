<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

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
            'description' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'required|file|mimes:jpg,jpeg,png|max:10240'
        ];
    }
}
