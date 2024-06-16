<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class modifyVetClassicRequest extends FormRequest
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
            "qte_vet" => "required|min:1",
        ];
    }

    public function messages()
    {
        return[
            "qte_vet.required" => "La quantité du vêtement est requise!",
            "qte_vet.min" => "La quantité du vêtement doit contenir au moins un chiffre!",
        ];
    }
}
