<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class gerantPostRequest extends FormRequest
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
            'entreprise' => 'required|min:2',
            'lieu_habitation' => 'required|min:2',
            'password' => 'required|min:2',
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
            'entreprise.required' => 'Le nom de l\'entreprise est requis!',
            'entreprise.min' => 'Le nom de l\'entreprise doit contenir deux caractères au minimum!',
            'lieu_habitation.required' => 'Le lieu d\'habitation est requis!',
            'lieu_habitation.min' => 'Le lieu d\'habitation doit contenir cinq caractères au minimum!',
            'password.required' => 'Le mot de passe est requis!',
            'password.min' => 'Le mot de passe doit contenir deux caractères au minimum!',
            'adresse.required' => 'L\'adresse est requise!',
            'adresse.min' => 'L\'adresse doit contenir deux caractères au minimum!',
            'photo.file' => 'Veuilliez importer un fichier svp!',
        ];

    }

}
