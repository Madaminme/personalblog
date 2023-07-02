<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:155',
            'email' => 'required|email|max:255',
            'phone' => 'required|regex:/[0-9]/|digits:12',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255'
        ];
    }
}
