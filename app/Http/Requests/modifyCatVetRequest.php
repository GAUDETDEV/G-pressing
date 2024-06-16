<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class modifyCatVetRequest extends FormRequest
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
            "nom_cat_vet" => "required|min:1",
        ];
    }

    public function messages()
    {

        return [
            //
            "nom_cat_vet.required" => "Veulliez spécifier le nom de la catégorie",
            "nom_cat_vet.min" => "Le nom de la catégorie doit être au minimum de un caractère(s)!",
        ];

    }
}
