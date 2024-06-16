<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postPrixRequest extends FormRequest
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
            "valeur_prix" => "required|min:3",
        ];
    }

    public function messages()
    {
        return [
            //
            "valeur_prix.required" => "Le prix est requis!",
            "valeur_prix.min" => "La valeur du prix doit contenir au moins trois chiffres!",
        ];
    }
}
