<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postLivraisonRequest extends FormRequest
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
            "nom_destinataire" => "required|min:3",
            "tel_destinataire" => "required",
            "heure_livraison" => "required",
        ];
    }

    public function messages()
    {

        return [
            "nom_destinataire.required" => "Le nom du destinataire est requis!",
            "nom_destinataire.min" => "Le nom du destinataire doit contenir au moins trois caractères!",
            "tel_destinataire.required" => "Le numéro de téléphone est requis!",
            "heure_livraison.required" => "L'heure de livraison doit être définie!",
        ];

    }
}
