<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class lessonRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:lessons',
            'description' => 'required|string|max:1000',
            'video' => 'required|file|mimes:mp4,mov,avi,flv|max:1000000',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
