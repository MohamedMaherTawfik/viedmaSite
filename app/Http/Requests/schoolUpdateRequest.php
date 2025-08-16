<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class schoolUpdateRequest extends FormRequest
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
            'name' => 'nullable|string|min:3',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'type' => 'nullable|string',
            'license_number' => 'nullable|string',
        ];
    }
}
