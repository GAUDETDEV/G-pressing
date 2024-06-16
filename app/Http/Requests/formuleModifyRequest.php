<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class formuleModifyRequest extends FormRequest
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
            'nom_formule' => 'required|min:2',
            'prix_formule' => 'required',
            'nbr_user' => 'required',
            'nbr_essai' => 'required',
            'periode' => 'required',
            'fonctionnalite' => 'required|min:15',
        ];
    }

    public function messages(){

        return[

            'nom_formule.required' => 'Le nom est requis!',
            'nom_formule.min' => 'Le nom doit contenir deux caractères au minimum!',
            'prix_formule.required' => 'Le prix est requis!',
            'nbr_user.required' => 'Le nombre d\'utilisateurs est requis!',
            'nbr_essai.required' => 'Le nombre d\éssai est requis!',
            'periode.required' => 'La période doit être définie!',
            'fonctionnalite.required' => 'Définissez la liste des fonctionnalités svp!',
            'fonctionnalite.min' => 'La liste des fonctionnalités doit contenir au moins 15 (quinze) caractères!',
        ];

    }


}
