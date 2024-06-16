<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class specificationPostRequest extends FormRequest
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
            'nom_specification_vet' => 'required|min:2',

        ];
    }

    public function messages()
    {
        return [
            'nom_specification_vet.required' => 'Le nom de la couleur est requis!',
            'nom_specification_vet.min' => 'Le nom de la couleur doit contenir deux caractères au minimum!',
        ];
    }


}
