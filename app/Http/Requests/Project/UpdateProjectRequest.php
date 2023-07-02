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
            'name' => ['nullable', 'string', Rule::unique('projects', 'name')->ignoreModel($project)],
            'client' => 'nullable|string',
            'url' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'required|file|mimes:jpg,jpeg,png|max:10240'
        ];
    }
}
