<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => 'nullable|email|unique:users,email|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|in:admin,teacher,user',
            'school_id' => 'required|exists:schools,id',
            'phone' => 'nullable|string|max:15',
            'topic' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|max:20',
            'nationallity' => 'nullable|string|max:50',
            'Academic_stage' => 'nullable|string|max:50',
        ];
    }
}