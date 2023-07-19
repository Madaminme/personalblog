<?php

namespace App\Http\Requests\Type;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTypeRequest extends FormRequest
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
        $type = request()->route('type');
        return [
            'name' => ['required', 'string', Rule::unique('types', 'name')->ignoreModel($type)],
            'slug' => ['nullable', 'string', Rule::unique('types', 'slug')]
        ];
    }
}
