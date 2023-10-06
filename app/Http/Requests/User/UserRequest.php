<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required|string|max:200",
            "username" => "required|string|max:200|unique:users,username",
            "email" => "required|email",
            "password" => "required|string|min:8",
            "instagram" => "nullable|url",
            "github" => "nullable|url",
            "telegram" => "nullable|url",
        ];
    }
}
