<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class depotPostNombreRequest extends FormRequest
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
            "type_depot" => "required|min:5",
            "nbr_vet" => "required|min:1",
            "prix_depot" => "required|min:4",
        ];
    }

    public function messages()
    {
        return[
            "type_depot.required" => "Le type du depot est requis!",
            "type_depot.min" => "Le type du depot doit contenir au moins cinq(5) caractères!",
            "nbr_vet.required" => "Le nombre de vêtements est requis!",
            "nbr_vet.min" => "Le nombre de vêtements doit contenir au moins un(1) chiffre!",
            "prix_depot.required" => "Le prix est requis!",
            "prix_depot.min" => "Le prix doit contenir au moins quatre(4) chiffre!",
        ];
    }


}
