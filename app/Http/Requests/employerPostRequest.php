<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class employerPostRequest extends FormRequest
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
            'name' => 'required|min:2',
            'email' => 'required|unique:users',
            'telephone' => 'required|unique:users',
            'lieu_habitation' => 'required|min:3',
            'debut_poste' => 'required',
            'fin_poste' => 'required',
            'password' => 'required|min:5',
            'adresse' => 'required|min:2',
            'photo' => 'nullable|file',

        ];
    }

    public function messages(){

        return[
            'name.required' => 'Le nom est requis!',
            'name.min' => 'Le nom doit contenir deux caractères au minimum!',
            'email.required' => 'L\'email est requis!',
            'email.unique' => 'Cette adresse mail est déjà occupée!',
            'telephone.required' => 'Le numéro de téléphone est requis!',
            'telephone.unique' => 'Ce numéro de téléphone est occupé!',
            'lieu_habitation.required' => 'Le lieu d\'habitation est requis!',
            'lieu_habitation.min' => 'Le nom du lieu doit contenir trois caractères au minimum!',
            'debut_poste.required' => 'Veulliez expécifier une date de prise de fonction!',
            'fin_poste.required' => 'Veulliez expécifier une date de fin de fonction!',
            'password.required' => 'Le mot de passe est requis!',
            'password.min' => 'Le mot de passe doit contenir cinq caractères au minimum!',
            'adresse.required' => 'L\'adresse est requise!',
            'adresse.min' => 'L\'adresse doit contenir deux caractères au minimum!',
            'photo.file' => 'Veuilliez importer un fichier svp!',
        ];

    }




}
