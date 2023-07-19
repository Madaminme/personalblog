<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $category = request()->route('category');
        return [
            'name' => ['nullable', 'string', 'max:255', Rule::unique('categories', 'name')->ignoreModel($category)],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('categories', 'slug')],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png']
        ];
    }
}
