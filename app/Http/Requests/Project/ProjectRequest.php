<?php

namespace App\Http\Requests\Project;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
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
        /** @var Project $project */

        return [
            'name' => ['required', 'string', Rule::unique('projects', 'name')],
            'slug' => ['nullable', 'string', Rule::unique('projects', 'slug')],
            'description' => 'required|string|max:255',
            'client' => 'required|string',
            'url' => 'required|string',
            'types' => 'required|array',
            'types*' => 'required|integer|exists:types,id',
            'tags' => 'required|array',
            'tags*' => 'required|integer|exists:tags,id',
            'images' => 'nullable|array',
            'images.*' => 'required|file|mimes:jpg,jpeg,png|max:10240'
        ];
    }
}
