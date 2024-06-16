<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class qualityPostRequest extends FormRequest
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
            //
            'nom' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom de la qualité est requis!',
            'nom.min' => 'Le nom de la qualité doit contenir deux caractères au minimum!',
        ];
    }
}
