<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class optCatVetPostRequest extends FormRequest
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
            "nom_cat_vet" => "required|min:4",
        ];
    }

    public function messages()
    {

        return [

            "nom_cat_vet.required" => "Le nom de la catégorie est requis!",
            "nom_cat_vet.min" => "Le nom de la catégorie doit compter quatre (4) caractères!",

        ];

    }


}
