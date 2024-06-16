<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class clientModifyRequest extends FormRequest
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
            'email' => 'required',
            'telephone' => 'required',
            'lieu_habitation' => 'required|min:2',
            'adresse' => 'required|min:2',
            'photo' => 'nullable|file',
        ];
    }

    public function messages(){

        return[
            'name.required' => 'Le nom est requis!',
            'name.min' => 'Le nom doit contenir deux caractères au minimum!',
            'email.required' => 'L\'email est requis!',
            'telephone.required' => 'Le numéro de téléphone est requis!',
            'lieu_habitation.required' => 'Précisez le lieu d\'habitation!',
            'lieu_habitation.min' => 'Le lieu d\'habitation doit contenir deux caractères au minimum!',
            'adresse.required' => 'L\'adresse est requise!',
            'adresse.min' => 'L\'adresse doit contenir deux caractères au minimum!',
        ];

    }


}
