<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_type' => 'required|string|in:student,teacher',
            'name' => 'required|string|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|regex:/(09)[0-9]{8}$/|unique:users',
            'school' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
            'subject' => $this->input('user_type') === 'teacher' ? 'required|array' : '', // Subject is required if user_type is teacher
            'avatar' => 'nullable|image|max:2048', // 2MB max file size, only image files
            'password' => 'required|string|min:8', // todo max password size ?
        ];
    }
}
