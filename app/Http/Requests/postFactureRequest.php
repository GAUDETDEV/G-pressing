<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postFactureRequest extends FormRequest
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
            'nom_titulaire'=>"required|min:3",
            'tel_titulaire'=>"required",
        ];
    }

    public function messages()
    {

        return [
            "nom_titulaire.required" => "Le nom du client est requis!",
            "nom_titulaire.min" => "Le nom du client doit contenir au moins trois caractères!",
            "tel_titulaire.required" => "Le numéro de téléphone est requis!",
        ];

    }


}
