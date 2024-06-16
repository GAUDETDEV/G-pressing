<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postCommuneRequest extends FormRequest
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
            "nom_commune" => "required|min:3",
        ];
    }


    public function messages()
    {
        return [
            //
            "nom_commune.required" => "Le nom de la commune est requis!",
            "nom_commune.min" => "Le nom de la commune doit contenir au moins trois caractères!",
        ];
    }
}
