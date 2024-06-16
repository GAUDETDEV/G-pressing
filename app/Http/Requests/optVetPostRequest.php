<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class optVetPostRequest extends FormRequest
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
            "nom_vet" => "required|min:2",
            "prix_vet" => "required|min:3",

        ];
    }

    public function messages()
    {
        return [
            'nom_vet.required' => 'Le nom du vêtement est requis!',
            'nom_vet.min' => 'Le nom du vêtement doit contenir 2 caractères au minimum!',
            'prix_vet.required' => 'Le prix du vêtement est requis!',
            'prix_vet.min' => 'Le prix du vêtement doit contenir 3 caractères au minimum!',
        ];
    }
}
