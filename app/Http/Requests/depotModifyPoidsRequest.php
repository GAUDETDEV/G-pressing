<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class depotModifyPoidsRequest extends FormRequest
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
            "poids_vet" => "required|min:1",
            "prix_depot" => "required|min:4",
        ];
    }


    public function messages()
    {
        return[

            "poids_vet.required" => "Le poids des vêtements est requis!",
            "poids_vet.min" => "Le poids des vêtements doit contenir au moins un(1) chiffre!",
            "prix_depot.required" => "Le prix est requis!",
            "prix_depot.min" => "Le prix doit contenir au moins quatre(4) chiffre!",
        ];
    }
}