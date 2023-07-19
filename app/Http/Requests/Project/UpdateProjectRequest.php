<?php

namespace App\Http\Requests\Project;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
        $project = request()->route('project');
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('projects', 'name')->ignoreModel($project)],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('projects', 'slug')],
            'description' => 'required|string|max:255',
            'client' => 'nullable|string',
            'url' => 'nullable|string',
            'types' => 'array|array',
            'types*' => 'required|integer|exists:types,id',
            'tags' => 'required|array',
            'tags*' => 'required|integer|exists:tags,id',
            'images' => 'nullable|array',
            'images.*' => 'required|file|mimes:jpg,jpeg,png|max:10240'
        ];
    }
}
