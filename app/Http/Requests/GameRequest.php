<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'nullable',
            'price' => 'required',
            'release_date' => 'nullable',
            'developer_name' => 'nullable',
            'cover_image' => 'required',
            'platform' => 'nullable',
            'trailer_url' => 'nullable',
            'stock' => 'nullable',
            'discount' => 'nullable',
            'user_id' => 'required',
        ];
    }
}
