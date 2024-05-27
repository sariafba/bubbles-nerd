<?php

namespace App\Http\Requests\Auth;

use App\Exceptions\FailedException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUSerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->authorizeUpdate();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        $rules = [
            'name' => 'string|max:255',
            'email' => 'email|unique:users|max:255',
            'phone' => 'regex:/(09)[0-9]{8}$/|unique:users',
            'avatar' => 'nullable|image|max:5120', // 5MB max file size, only image files
        ];


        return $rules;
    }

    public function authorizeUpdate(): bool
    {
        // Only a student can update the school
        if ($this->has('school') && $this->user()->user_type !== 'student') {

    throw new FailedException('You should be student');
        }

        // Only a teacher can update the bio
        if ($this->has('bio') && $this->user()->user_type !== 'teacher') {
            throw new FailedException('You should be teacher');
        }

        return true;
    }

}
