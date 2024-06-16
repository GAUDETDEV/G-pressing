<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class colorPostRequest extends FormRequest
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
            'nom_couleur_vet' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'nom_couleur_vet.required' => 'Le nom de la couleur est requis!',
            'nom_couleur_vet.min' => 'Le nom de la couleur doit contenir deux caractères au minimum!',
        ];
    }


}
