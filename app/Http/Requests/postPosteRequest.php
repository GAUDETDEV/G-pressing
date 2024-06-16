<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postPosteRequest extends FormRequest
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
            'titre_poste'=>"required|min:5",
            'desc_poste'=>"required|min:10",
            'salaire_poste'=>"required|max:5",
        ];
    }

    public function messages()
    {
        return [
            //
            "titre_poste.required" => "Le titre du poste est requis!",
            "titre_poste.min" => "Le titre du poste doit contenir au moins cinq caractères!",
            "desc_poste.required" => "La description du poste est requis!",
            "desc_poste.min" => "La description du poste doit contenir au moins dix caractères!",
            "salaire_poste.required" => "Le salaire est requis!",
            "salaire_poste.max" => "La valeur du salaire ne doit pas dépasser les cinq chiffres!",
        ];
    }


}
