<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postAdresseRequest extends FormRequest
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
            "nom_adresse" => "required|min:3",
        ];
    }

    public function messages()
    {
        return [
            //
            "nom_adresse.required" => "Le nom de l'adresse est requis!",
            "nom_adresse.min" => "Le nom de l'adresse doit contenir au moins trois caractères!",
        ];
    }
}
