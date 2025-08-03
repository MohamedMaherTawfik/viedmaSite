<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class certificateRequest extends FormRequest
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
            'student_id' => 'nullable|integer',
            'teacher_id' => 'nullable|integer',
            'user_id' => 'required|integer',
            'status' => 'required|string',
            'certificate' => 'required|string',
            'courses_id' => 'required|integer',
            'file' => 'required',
        ];
    }
}
