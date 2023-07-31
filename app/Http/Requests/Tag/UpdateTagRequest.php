<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
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
        $tag = request()->route('tag');
        return [
            'name' => ['nullable', 'string', Rule::unique('tags', 'name')->ignoreModel($tag)],
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240'
        ];
    }
}
