<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postQuartierRequest extends FormRequest
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
            "nom_quartier" => "required|min:3",
        ];
    }

    public function messages()
    {
        return [
            //
            "nom_quartier.required" => "Le nom du quartier est requis!",
            "nom_quartier.min" => "Le nom du quartier doit contenir au moins trois caractères!",
        ];
    }
}
